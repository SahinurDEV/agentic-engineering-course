<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class NoteController extends Controller
{
    /**
     * Add an internal note (R8). Customers never see it.
     */
    public function store(StoreNoteRequest $request, Ticket $ticket): RedirectResponse
    {
        $ticket->addNote($request->user(), $request->validated('body'));

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Note added.')]);

        return to_route('tickets.show', $ticket);
    }
}
