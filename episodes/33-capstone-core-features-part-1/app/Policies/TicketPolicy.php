<?php

namespace App\Policies;

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
     * Whoever can see a ticket can reply to it (R7).
     * Closed tickets come with R10 in Episode 34.
     */
    public function reply(User $user, Ticket $ticket): Response
    {
        return $this->view($user, $ticket);
    }
}
