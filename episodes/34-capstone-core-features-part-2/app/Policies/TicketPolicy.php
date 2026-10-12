<?php

namespace App\Policies;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TicketPolicy
{
    /**
     * The inbox of every ticket is for agents (R4).
     */
    public function viewAny(User $user): bool
    {
        return $user->isAgent();
    }

    /**
     * Agents see every ticket; a customer sees only their own (R3).
     * Anyone else gets a 404, so ticket ids reveal nothing.
     */
    public function view(User $user, Ticket $ticket): Response
    {
        return $user->isAgent() || $ticket->customer_id === $user->id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Customers open tickets (R2).
     */
    public function create(User $user): bool
    {
        return ! $user->isAgent();
    }

    /**
     * Whoever can see a ticket can reply to it, unless it is closed (R7, R10).
     */
    public function reply(User $user, Ticket $ticket): Response
    {
        $view = $this->view($user, $ticket);

        if ($view->denied()) {
            return $view;
        }

        return $ticket->status === TicketStatus::Closed
            ? Response::deny(__('Closed tickets take no replies.'))
            : Response::allow();
    }

    /**
     * Agents change status, priority and assignee (R9, R10).
     */
    public function update(User $user, Ticket $ticket): Response
    {
        return $this->agentOnly($user, $ticket);
    }

    /**
     * Agents add internal notes and read them (R8).
     */
    public function addNote(User $user, Ticket $ticket): Response
    {
        return $this->agentOnly($user, $ticket);
    }

    /**
     * The ticket's owner gets a 403; anyone else who can't see it, a 404.
     */
    private function agentOnly(User $user, Ticket $ticket): Response
    {
        $view = $this->view($user, $ticket);

        if ($view->denied()) {
            return $view;
        }

        return $user->isAgent() ? Response::allow() : Response::deny();
    }
}
