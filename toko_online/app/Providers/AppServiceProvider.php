<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        // Admin bisa mengelola role
        Gate::define('manage-roles', fn (User $user) => $user->role === 'admin');
        
        // Admin bisa mengelola produk
        Gate::define('manage-products', fn (User $user) => $user->role === 'admin');
        
        // Staff & Admin bisa menyesuaikan stok
        Gate::define('adjust-stock', fn (User $user) => in_array($user->role, ['staff', 'admin']));
        
        // Hanya Customer yang boleh pakai keranjang (Cart W06)
        Gate::define('use-cart', fn (User $user) => $user->role === 'customer');
    }
}
