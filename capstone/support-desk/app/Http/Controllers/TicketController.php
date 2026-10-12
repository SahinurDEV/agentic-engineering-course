<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Category;
use App\Models\InternalNote;
use App\Models\Reply;
use App\Models\Ticket;
use App\Models\TicketChange;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TicketController extends Controller
{
    /**
     * The signed-in user's own tickets, newest first (R3).
     */
    public function index(Request $request): Response
    {
        $tickets = $request->user()->tickets()
            ->with('category')
            ->orderByDesc('id')
            ->paginate(25)
            ->through(fn (Ticket $ticket) => [
                'id' => $ticket->id,
                'subject' => $ticket->subject,
                'status' => $ticket->status,
                'priority' => $ticket->priority,
                'category' => $ticket->category->name,
                'created_at' => $ticket->created_at,
            ]);

        return Inertia::render('tickets/index', ['tickets' => $tickets]);
    }

    /**
     * The form to open a ticket (R2), with active categories only (R12).
     */
    public function create(): Response
    {
        return Inertia::render('tickets/create', [
            'categories' => Category::query()->active()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    /**
     * Open a ticket. The customer comes from the session, never from the form.
     */
    public function store(StoreTicketRequest $request): RedirectResponse
    {
        $ticket = $request->user()->tickets()->create($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Ticket opened.')]);

        return to_route('tickets.show', $ticket);
    }

    /**
     * One ticket with its public replies and its change log (R11).
     * Internal notes are loaded only for agents (R3, R8).
     */
    public function show(Request $request, Ticket $ticket): Response
    {
        $user = $request->user();
        $isAgent = $user->isAgent();

        $ticket->load(['category', 'customer', 'assignee', 'replies.author', 'history.user']);

        if ($isAgent) {
            $ticket->load('internalNotes.author');
        }

        return Inertia::render('tickets/show', [
            'ticket' => [
                'id' => $ticket->id,
                'subject' => $ticket->subject,
                'description' => $ticket->description,
                'status' => $ticket->status,
                'priority' => $ticket->priority,
                'category' => $ticket->category->name,
                'customer' => $ticket->customer->name,
                'assignee' => $ticket->assignee?->name,
                'assignee_id' => $ticket->assignee_id,
                'created_at' => $ticket->created_at,
            ],
            'replies' => $ticket->replies->map(fn (Reply $reply) => [
                'id' => $reply->id,
                'body' => $reply->body,
                'author' => $reply->author?->name,
                'from_agent' => (bool) $reply->author?->isAgent(),
                'created_at' => $reply->created_at,
            ]),
            'history' => $this->history($ticket),
            'notes' => $isAgent
                ? $ticket->internalNotes->map(fn (InternalNote $note) => [
                    'id' => $note->id,
                    'body' => $note->body,
                    'author' => $note->author?->name,
                    'created_at' => $note->created_at,
                ])
                : null,
            'agents' => $isAgent
                ? User::query()->whereIn('role', [Role::Agent, Role::Admin])->orderBy('name')->get(['id', 'name'])
                : null,
            'can' => [
                'reply' => $user->can('reply', $ticket),
                'update' => $user->can('update', $ticket),
                'addNote' => $user->can('addNote', $ticket),
            ],
        ]);
    }

    /**
     * The change log with names. Assignee values are user ids, looked up in one query.
     *
     * @return array<int, array<string, mixed>>
     */
    private function history(Ticket $ticket): array
    {
        $ids = $ticket->history
            ->where('field', 'assignee')
            ->flatMap(fn (TicketChange $change) => [$change->old_value, $change->new_value])
            ->filter()
            ->unique();

        $names = User::query()->whereIn('id', $ids)->pluck('name', 'id');

        $value = fn (TicketChange $change, ?string $raw) => $change->field === 'assignee' && $raw !== null
            ? ($names[(int) $raw] ?? __('Deleted user'))
            : $raw;

        return $ticket->history->map(fn (TicketChange $change) => [
            'id' => $change->id,
            'field' => $change->field,
            'old' => $value($change, $change->old_value),
            'new' => $value($change, $change->new_value),
            'user' => $change->user?->name,
            'created_at' => $change->created_at,
        ])->values()->all();
    }
}
