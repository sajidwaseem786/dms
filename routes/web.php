<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// Central/Landlord routes
Route::get('/', function () {
    return view('welcome');
});

// Tenant routes
Route::middleware([
    'web',
    \Stancl\Tenancy\Middleware\InitializeTenancyByDomain::class,
    \Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'Tenant app: ' . tenant('id');
    });
});
