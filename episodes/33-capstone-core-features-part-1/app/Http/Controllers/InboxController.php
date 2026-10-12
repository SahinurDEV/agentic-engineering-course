<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class InboxController extends Controller
{
    /**
     * Every ticket, newest first, 25 per page (R4), with filters (R5).
     * Unknown filter values are ignored, never passed to the query.
     */
    public function __invoke(Request $request): Response
    {
        $filters = [
            'status' => TicketStatus::tryFrom($request->string('status')->value())?->value,
            'priority' => TicketPriority::tryFrom($request->string('priority')->value())?->value,
            'category' => $request->integer('category') ?: null,
            'assignee' => $request->input('assignee') === 'none'
                ? 'none'
                : ($request->integer('assignee') ?: null),
        ];

        $tickets = Ticket::query()
            ->with(['category', 'customer', 'assignee'])
            ->when($filters['status'], fn (Builder $query, string $status) => $query->where('status', $status))
            ->when($filters['priority'], fn (Builder $query, string $priority) => $query->where('priority', $priority))
            ->when($filters['category'], fn (Builder $query, int $category) => $query->where('category_id', $category))
            ->when($filters['assignee'], fn (Builder $query, int|string $assignee) => $assignee === 'none'
                ? $query->whereNull('assignee_id')
                : $query->where('assignee_id', $assignee))
            ->orderByDesc('id')
            ->paginate(25)
            ->withQueryString()
            ->through(fn (Ticket $ticket) => [
                'id' => $ticket->id,
                'subject' => $ticket->subject,
                'status' => $ticket->status,
                'priority' => $ticket->priority,
                'category' => $ticket->category->name,
                'customer' => $ticket->customer->name,
                'assignee' => $ticket->assignee?->name,
                'created_at' => $ticket->created_at,
            ]);

        return Inertia::render('inbox', [
            'tickets' => $tickets,
            'filters' => $filters,
            'categories' => Category::query()->orderBy('name')->get(['id', 'name']),
            'agents' => User::query()->whereIn('role', [Role::Agent, Role::Admin])->orderBy('name')->get(['id', 'name']),
        ]);
    }
}
