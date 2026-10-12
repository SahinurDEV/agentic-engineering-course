<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyRequest;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class ReplyController extends Controller
{
    /**
     * Add a public reply (R7). The author is always the signed-in user.
     */
    public function store(StoreReplyRequest $request, Ticket $ticket): RedirectResponse
    {
        $ticket->addReply($request->user(), $request->validated('body'));

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Reply sent.')]);

        return to_route('tickets.show', $ticket);
    }
}
