<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Models\Category;
use App\Models\Reply;
use App\Models\Ticket;
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
     * The form to open a ticket (R2).
     */
    public function create(): Response
    {
        return Inertia::render('tickets/create', [
            'categories' => Category::query()->orderBy('name')->get(['id', 'name']),
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
     * One ticket with its public replies. Internal notes are never loaded here (R3).
     */
    public function show(Ticket $ticket): Response
    {
        $ticket->load(['category', 'customer', 'assignee', 'replies.author']);

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
                'created_at' => $ticket->created_at,
            ],
            'replies' => $ticket->replies->map(fn (Reply $reply) => [
                'id' => $reply->id,
                'body' => $reply->body,
                'author' => $reply->author?->name,
                'from_agent' => (bool) $reply->author?->isAgent(),
                'created_at' => $reply->created_at,
            ]),
        ]);
    }
}
