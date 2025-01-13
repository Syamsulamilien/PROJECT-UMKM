<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function view(User $user, Order $order)
    {
        return $user->id === $order->user_id || $user->is_admin;
    }

    public function viewAny(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Order $order)
    {
        return $user->is_admin;
    }

    public function delete(User $user, Order $order)
    {
        return $user->is_admin;
    }
}