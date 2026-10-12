<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * One logged change to a ticket's status, priority or assignee (R11).
 *
 * @property int $id
 * @property string $field
 * @property string|null $old_value
 * @property string|null $new_value
 * @property int|null $user_id
 * @property CarbonImmutable $created_at
 */
#[Fillable(['field', 'old_value', 'new_value'])]
class TicketChange extends Model
{
    /**
     * Log entries are never edited, so there is no updated_at.
     */
    public const UPDATED_AT = null;

    /**
     * @return BelongsTo<Ticket, $this>
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Who made the change. Null when that account was deleted.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
