<?php

namespace App\Http\Controllers;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TicketUpdateController extends Controller
{
    /**
     * Change status and priority (R10) and the assignee (R9).
     * Each Ticket method logs what changed (R11); all of it is saved together.
     */
    public function __invoke(UpdateTicketRequest $request, Ticket $ticket): RedirectResponse
    {
        $by = $request->user();
        $data = $request->validated();

        DB::transaction(function () use ($ticket, $by, $data) {
            if (array_key_exists('status', $data)) {
                $ticket->changeStatus($by, TicketStatus::from($data['status']));
            }

            if (array_key_exists('priority', $data)) {
                $ticket->changePriority($by, TicketPriority::from($data['priority']));
            }

            if (array_key_exists('assignee_id', $data)) {
                $ticket->assignTo($by, $data['assignee_id'] === null ? null : User::query()->whereKey($data['assignee_id'])->firstOrFail());
            }
        });

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Ticket updated.')]);

        return to_route('tickets.show', $ticket);
    }
}
