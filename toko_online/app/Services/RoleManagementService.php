<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class RoleManagementService
{
    public function changeRole(User $actor, User $target, string $newRole): void
    {
        // BR-04: Admin tidak boleh ubah dirinya sendiri atau akun admin lain
        if ($actor->is($target) || $target->role === 'admin') {
            throw ValidationException::withMessages([
                'role' => 'Akun admin tidak dapat diubah di fitur ini.'
            ]);
        }

        // BR-05: Jika role sama, jangan lakukan save (Observer tidak akan jalan)
        if ($target->role === $newRole) {
            return;
        }

        // Lakukan perubahan
        $target->role = $newRole;
        $target->save();
    }
}