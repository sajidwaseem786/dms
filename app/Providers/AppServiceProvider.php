<?php

namespace App\Providers;

use App\Auth\TenantSessionGuard;
use App\Auth\TenantUserProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Register custom tenant user provider
        Auth::provider('tenant-eloquent', function ($app, array $config) {
            return new TenantUserProvider($app['hash'], $config['model']);
        });
        
        // Register custom tenant session guard
        Auth::extend('tenant-session', function ($app, $name, array $config) {
            $provider = Auth::createUserProvider($config['provider']);
            
            $guard = new TenantSessionGuard(
                $name,
                $provider,
                $app['session.store'],
                $app['request']
            );

            if (method_exists($guard, 'setCookieJar')) {
                $guard->setCookieJar($app['cookie']);
            }

            if (method_exists($guard, 'setDispatcher')) {
                $guard->setDispatcher($app['events']);
            }

            if (method_exists($guard, 'setRequest')) {
                $guard->setRequest($app->refresh('request', $guard, 'setRequest'));
            }

            return $guard;
        });
    }
}