<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // Hanya jalan jika kolom 'role' yang berubah
        if (! $user->wasChanged('role')) {
            return;
        }

        Log::info('user.role.changed', [
            'target_user_id' => $user->id_user ?? $user->id, // sesuaikan dengan PK W05
            'old_role' => $user->getRawOriginal('role'),     // role sebelum berubah
            'new_role' => $user->role,                       // role baru
            'actor_id' => Auth::id(),                        // siapa yang mengubah
        ]);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
