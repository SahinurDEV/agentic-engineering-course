<?php

namespace App\Models;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use Database\Factories\TicketFactory;
use DomainException;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

/**
 * @property int $id
 * @property string $subject
 * @property string $description
 * @property TicketStatus $status
 * @property TicketPriority $priority
 * @property int $customer_id
 * @property int|null $assignee_id
 */
#[Fillable(['subject', 'description', 'category_id'])]
class Ticket extends Model
{
    /** @use HasFactory<TicketFactory> */
    use HasFactory;

    /**
     * New tickets are open, with normal priority.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'status' => 'open',
        'priority' => 'normal',
    ];

    /**
     * Columns whose changes are logged (R11), and their name in the log.
     */
    private const LOGGED = [
        'status' => 'status',
        'priority' => 'priority',
        'assignee_id' => 'assignee',
    ];

    protected function casts(): array
    {
        return [
            'status' => TicketStatus::class,
            'priority' => TicketPriority::class,
        ];
    }

    /**
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    /**
     * Public replies, oldest first. Never includes internal notes.
     *
     * @return HasMany<Reply, $this>
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class)->orderBy('id');
    }

    /**
     * Internal notes, oldest first. Kept apart from replies.
     *
     * @return HasMany<InternalNote, $this>
     */
    public function internalNotes(): HasMany
    {
        return $this->hasMany(InternalNote::class)->orderBy('id');
    }

    public function addReply(User $author, string $body): Reply
    {
        $reply = new Reply(['body' => $body]);
        $reply->author()->associate($author);
        $reply->ticket()->associate($this);
        $reply->save();

        return $reply;
    }

    /**
     * A public reply with the R10 rules: closed tickets take no replies, and a
     * customer reply on a pending or resolved ticket sets it to open (logged).
     */
    public function respond(User $author, string $body): Reply
    {
        if ($this->status === TicketStatus::Closed) {
            throw new DomainException('Closed tickets take no replies.');
        }

        return DB::transaction(function () use ($author, $body) {
            $reply = $this->addReply($author, $body);

            if (! $author->isAgent() && in_array($this->status, [TicketStatus::Pending, TicketStatus::Resolved], true)) {
                $this->changeStatus($author, TicketStatus::Open);
            }

            return $reply;
        });
    }

    public function addNote(User $author, string $body): InternalNote
    {
        if (! $author->isAgent()) {
            throw new InvalidArgumentException('Only agents can write internal notes.');
        }

        $note = new InternalNote(['body' => $body]);
        $note->author()->associate($author);
        $note->ticket()->associate($this);
        $note->save();

        return $note;
    }

    /**
     * The change log, oldest first.
     *
     * @return HasMany<TicketChange, $this>
     */
    public function history(): HasMany
    {
        return $this->hasMany(TicketChange::class)->orderBy('id');
    }

    public function changeStatus(User $by, TicketStatus $status): void
    {
        $this->status = $status;
        $this->saveAndLog($by);
    }

    public function changePriority(User $by, TicketPriority $priority): void
    {
        $this->priority = $priority;
        $this->saveAndLog($by);
    }

    public function assignTo(User $by, ?User $agent): void
    {
        if ($agent !== null && ! $agent->isAgent()) {
            throw new InvalidArgumentException('Only agents can be assigned.');
        }

        $this->assignee()->associate($agent);
        $this->saveAndLog($by);
    }

    /**
     * Tickets with all these words in the subject or in a reply (R6).
     * Internal notes are not searched.
     *
     * @param  Builder<Ticket>  $query
     */
    #[Scope]
    protected function search(Builder $query, string $words): void
    {
        $query->whereIn('id', Ticket::query()
            ->select('id')
            ->whereFullText('subject', $words, ['language' => 'english'])
            ->union(Reply::query()
                ->select('ticket_id')
                ->whereFullText('body', $words, ['language' => 'english'])));
    }

    /**
     * Save the ticket and log each changed column, together or not at all.
     */
    private function saveAndLog(User $by): void
    {
        $changes = [];

        foreach (self::LOGGED as $column => $field) {
            if ($this->isDirty($column)) {
                $changes[] = new TicketChange([
                    'field' => $field,
                    'old_value' => self::asText($this->getRawOriginal($column)),
                    'new_value' => self::asText($this->getAttributes()[$column]),
                ]);
            }
        }

        if ($changes === []) {
            return;
        }

        DB::transaction(function () use ($by, $changes) {
            $this->save();

            foreach ($changes as $change) {
                $change->user()->associate($by);
                $this->history()->save($change);
            }
        });
    }

    private static function asText(mixed $value): ?string
    {
        return $value === null ? null : (string) $value;
    }
}
