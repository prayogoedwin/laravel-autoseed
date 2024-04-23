<?php

namespace Astamatech\LaravelAutoseed;

use Illuminate\Support\ServiceProvider;

class LaravelAutoseedServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Registrasi service di sini jika diperlukan
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Di sini Anda bisa melakukan bootstrapping,
        // seperti mendaftarkan command atau menambahkan view
    }
}
