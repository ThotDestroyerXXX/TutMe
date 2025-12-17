<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Configure writable paths for Vercel (read-only filesystem)
        // Vercel only allows writes to /tmp directory
        if (
            isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) ||
            config('app.env') === 'production'
        ) {
            // Set temporary directory to /tmp (only writable directory on Vercel)
            config([
                'excel.exports.temp_path' => '/tmp',
                'excel.cache.path' => '/tmp',
                'excel.local_path' => '/tmp',
                'filesystems.disks.local.root' => '/tmp',
                'filesystems.disks.temp.root' => '/tmp',
            ]);
        }
    }
}
