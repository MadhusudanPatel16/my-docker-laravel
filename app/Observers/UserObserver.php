<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     */
    public function creating(User $user)
    {
        // Before a user is created
        Log::info('Creating user: ' . $user->email);
        Log::info('Creating user: ' . $user->name);
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user)
    {
        // After a user is created
        Log::info('User created: ' . $user->email);
        Log::info('User created: ' . $user->name);

        // Example: send welcome email
        Mail::to($user->email)->send(new \App\Mail\WelcomeMail($user));
    }

    /**
     * Handle the User "updating" event.
     */
    public function updating(User $user)
    {
        Log::info('Updating user: ' . $user->id);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user)
    {
        Log::info('User updated: ' . $user->id);
    }

    /**
     * Handle the User "deleting" event.
     */
    public function deleting(User $user)
    {
        Log::info('Deleting user: ' . $user->id);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user)
    {
        Log::info('User deleted: ' . $user->id);
    }
}
