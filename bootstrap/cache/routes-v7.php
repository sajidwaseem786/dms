<?php

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/landlord/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.auth.login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/landlord/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.auth.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/landlord' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.admin.pages.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.tenant.auth.login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.tenant.auth.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.tenant.pages.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/events' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.tenant.resources.events.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/events/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.tenant.resources.events.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/roles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.tenant.resources.roles.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/roles/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.tenant.resources.roles.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.tenant.resources.users.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/users/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.tenant.resources.users.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/volunteer-registrations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.tenant.resources.volunteer-registrations.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/volunteer-registrations/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.tenant.resources.volunteer-registrations.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/livewire/livewire.js' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::u5EncYuhPSwQ9UXq',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/livewire/livewire.min.js.map' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rqAUU17tAFCg4hj8',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/livewire/upload-file' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'livewire.upload-file',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/up' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4lh5cBaQIchIkZUj',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bRu8g80epjLamf8L',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/livewire/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'livewire.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/filament/(?|exports/([^/]++)/download(*:45)|imports/([^/]++)/failed\\-rows/download(*:90))|/admin/(?|events/([^/]++)/edit(*:128)|roles/([^/]++)/edit(*:155)|users/([^/]++)/edit(*:182)|volunteer\\-registrations/([^/]++)/edit(*:228))|/livewire/preview\\-file/([^/]++)(*:269)|/tenancy/assets(?:/((?:.*)))?(*:306)|/storage/(.*)(*:327))/?$}sDu',
    ),
    3 => 
    array (
      45 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.exports.download',
          ),
          1 => 
          array (
            0 => 'export',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      90 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.imports.failed-rows.download',
          ),
          1 => 
          array (
            0 => 'import',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      128 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.tenant.resources.events.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      155 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.tenant.resources.roles.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      182 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.tenant.resources.users.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      228 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'filament.tenant.resources.volunteer-registrations.edit',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      269 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'livewire.preview-file',
          ),
          1 => 
          array (
            0 => 'filename',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      306 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'stancl.tenancy.asset',
            'path' => NULL,
          ),
          1 => 
          array (
            0 => 'path',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      327 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'storage.local',
          ),
          1 => 
          array (
            0 => 'path',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'filament.exports.download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'filament/exports/{export}/download',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'filament.actions',
        ),
        'uses' => 'Filament\\Actions\\Exports\\Http\\Controllers\\DownloadExport@__invoke',
        'controller' => 'Filament\\Actions\\Exports\\Http\\Controllers\\DownloadExport',
        'as' => 'filament.exports.download',
        'namespace' => NULL,
        'prefix' => 'filament',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.imports.failed-rows.download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'filament/imports/{import}/failed-rows/download',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'filament.actions',
        ),
        'uses' => 'Filament\\Actions\\Imports\\Http\\Controllers\\DownloadImportFailureCsv@__invoke',
        'controller' => 'Filament\\Actions\\Imports\\Http\\Controllers\\DownloadImportFailureCsv',
        'as' => 'filament.imports.failed-rows.download',
        'namespace' => NULL,
        'prefix' => 'filament',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.auth.login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'landlord/login',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          2 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          3 => 'Illuminate\\Session\\Middleware\\StartSession',
          4 => 'Illuminate\\Session\\Middleware\\AuthenticateSession',
          5 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          6 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          7 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          8 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          9 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
        ),
        'uses' => 'Filament\\Auth\\Pages\\Login@__invoke',
        'controller' => 'Filament\\Auth\\Pages\\Login',
        'as' => 'filament.admin.auth.login',
        'namespace' => NULL,
        'prefix' => '/landlord',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.auth.logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'landlord/logout',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          2 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          3 => 'Illuminate\\Session\\Middleware\\StartSession',
          4 => 'Illuminate\\Session\\Middleware\\AuthenticateSession',
          5 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          6 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          7 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          8 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          9 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          10 => 'Filament\\Http\\Middleware\\Authenticate',
        ),
        'uses' => 'Filament\\Auth\\Http\\Controllers\\LogoutController@__invoke',
        'controller' => 'Filament\\Auth\\Http\\Controllers\\LogoutController',
        'as' => 'filament.admin.auth.logout',
        'namespace' => NULL,
        'prefix' => '/landlord',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.admin.pages.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'landlord',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:admin',
          1 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          2 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          3 => 'Illuminate\\Session\\Middleware\\StartSession',
          4 => 'Illuminate\\Session\\Middleware\\AuthenticateSession',
          5 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          6 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          7 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          8 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          9 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          10 => 'Filament\\Http\\Middleware\\Authenticate',
        ),
        'uses' => 'Filament\\Pages\\Dashboard@__invoke',
        'controller' => 'Filament\\Pages\\Dashboard',
        'as' => 'filament.admin.pages.dashboard',
        'namespace' => NULL,
        'prefix' => 'landlord/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.tenant.auth.login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/login',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:tenant',
          1 => 'Stancl\\Tenancy\\Middleware\\InitializeTenancyByDomain',
          2 => 'Stancl\\Tenancy\\Middleware\\PreventAccessFromCentralDomains',
          3 => 'App\\Http\\Middleware\\EnsureTenantDatabase',
          4 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          5 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          6 => 'Illuminate\\Session\\Middleware\\StartSession',
          7 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          8 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          9 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          10 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          11 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          12 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
        ),
        'uses' => 'Filament\\Auth\\Pages\\Login@__invoke',
        'controller' => 'Filament\\Auth\\Pages\\Login',
        'as' => 'filament.tenant.auth.login',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.tenant.auth.logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/logout',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:tenant',
          1 => 'Stancl\\Tenancy\\Middleware\\InitializeTenancyByDomain',
          2 => 'Stancl\\Tenancy\\Middleware\\PreventAccessFromCentralDomains',
          3 => 'App\\Http\\Middleware\\EnsureTenantDatabase',
          4 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          5 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          6 => 'Illuminate\\Session\\Middleware\\StartSession',
          7 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          8 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          9 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          10 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          11 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          12 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          13 => 'Filament\\Http\\Middleware\\Authenticate',
        ),
        'uses' => 'Filament\\Auth\\Http\\Controllers\\LogoutController@__invoke',
        'controller' => 'Filament\\Auth\\Http\\Controllers\\LogoutController',
        'as' => 'filament.tenant.auth.logout',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.tenant.pages.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:tenant',
          1 => 'Stancl\\Tenancy\\Middleware\\InitializeTenancyByDomain',
          2 => 'Stancl\\Tenancy\\Middleware\\PreventAccessFromCentralDomains',
          3 => 'App\\Http\\Middleware\\EnsureTenantDatabase',
          4 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          5 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          6 => 'Illuminate\\Session\\Middleware\\StartSession',
          7 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          8 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          9 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          10 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          11 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          12 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          13 => 'Filament\\Http\\Middleware\\Authenticate',
        ),
        'uses' => 'Filament\\Pages\\Dashboard@__invoke',
        'controller' => 'Filament\\Pages\\Dashboard',
        'as' => 'filament.tenant.pages.dashboard',
        'namespace' => NULL,
        'prefix' => 'admin/',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.tenant.resources.events.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/events',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:tenant',
          1 => 'Stancl\\Tenancy\\Middleware\\InitializeTenancyByDomain',
          2 => 'Stancl\\Tenancy\\Middleware\\PreventAccessFromCentralDomains',
          3 => 'App\\Http\\Middleware\\EnsureTenantDatabase',
          4 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          5 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          6 => 'Illuminate\\Session\\Middleware\\StartSession',
          7 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          8 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          9 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          10 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          11 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          12 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          13 => 'Filament\\Http\\Middleware\\Authenticate',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Tenant\\Resources\\Events\\Pages\\ListEvents@__invoke',
        'controller' => 'App\\Filament\\Tenant\\Resources\\Events\\Pages\\ListEvents',
        'as' => 'filament.tenant.resources.events.index',
        'namespace' => NULL,
        'prefix' => 'admin/events',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.tenant.resources.events.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/events/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:tenant',
          1 => 'Stancl\\Tenancy\\Middleware\\InitializeTenancyByDomain',
          2 => 'Stancl\\Tenancy\\Middleware\\PreventAccessFromCentralDomains',
          3 => 'App\\Http\\Middleware\\EnsureTenantDatabase',
          4 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          5 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          6 => 'Illuminate\\Session\\Middleware\\StartSession',
          7 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          8 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          9 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          10 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          11 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          12 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          13 => 'Filament\\Http\\Middleware\\Authenticate',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Tenant\\Resources\\Events\\Pages\\CreateEvent@__invoke',
        'controller' => 'App\\Filament\\Tenant\\Resources\\Events\\Pages\\CreateEvent',
        'as' => 'filament.tenant.resources.events.create',
        'namespace' => NULL,
        'prefix' => 'admin/events',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.tenant.resources.events.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/events/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:tenant',
          1 => 'Stancl\\Tenancy\\Middleware\\InitializeTenancyByDomain',
          2 => 'Stancl\\Tenancy\\Middleware\\PreventAccessFromCentralDomains',
          3 => 'App\\Http\\Middleware\\EnsureTenantDatabase',
          4 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          5 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          6 => 'Illuminate\\Session\\Middleware\\StartSession',
          7 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          8 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          9 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          10 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          11 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          12 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          13 => 'Filament\\Http\\Middleware\\Authenticate',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Tenant\\Resources\\Events\\Pages\\EditEvent@__invoke',
        'controller' => 'App\\Filament\\Tenant\\Resources\\Events\\Pages\\EditEvent',
        'as' => 'filament.tenant.resources.events.edit',
        'namespace' => NULL,
        'prefix' => 'admin/events',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.tenant.resources.roles.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:tenant',
          1 => 'Stancl\\Tenancy\\Middleware\\InitializeTenancyByDomain',
          2 => 'Stancl\\Tenancy\\Middleware\\PreventAccessFromCentralDomains',
          3 => 'App\\Http\\Middleware\\EnsureTenantDatabase',
          4 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          5 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          6 => 'Illuminate\\Session\\Middleware\\StartSession',
          7 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          8 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          9 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          10 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          11 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          12 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          13 => 'Filament\\Http\\Middleware\\Authenticate',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Tenant\\Resources\\Roles\\Pages\\ListRoles@__invoke',
        'controller' => 'App\\Filament\\Tenant\\Resources\\Roles\\Pages\\ListRoles',
        'as' => 'filament.tenant.resources.roles.index',
        'namespace' => NULL,
        'prefix' => 'admin/roles',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.tenant.resources.roles.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:tenant',
          1 => 'Stancl\\Tenancy\\Middleware\\InitializeTenancyByDomain',
          2 => 'Stancl\\Tenancy\\Middleware\\PreventAccessFromCentralDomains',
          3 => 'App\\Http\\Middleware\\EnsureTenantDatabase',
          4 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          5 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          6 => 'Illuminate\\Session\\Middleware\\StartSession',
          7 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          8 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          9 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          10 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          11 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          12 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          13 => 'Filament\\Http\\Middleware\\Authenticate',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Tenant\\Resources\\Roles\\Pages\\CreateRole@__invoke',
        'controller' => 'App\\Filament\\Tenant\\Resources\\Roles\\Pages\\CreateRole',
        'as' => 'filament.tenant.resources.roles.create',
        'namespace' => NULL,
        'prefix' => 'admin/roles',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.tenant.resources.roles.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:tenant',
          1 => 'Stancl\\Tenancy\\Middleware\\InitializeTenancyByDomain',
          2 => 'Stancl\\Tenancy\\Middleware\\PreventAccessFromCentralDomains',
          3 => 'App\\Http\\Middleware\\EnsureTenantDatabase',
          4 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          5 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          6 => 'Illuminate\\Session\\Middleware\\StartSession',
          7 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          8 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          9 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          10 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          11 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          12 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          13 => 'Filament\\Http\\Middleware\\Authenticate',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Tenant\\Resources\\Roles\\Pages\\EditRole@__invoke',
        'controller' => 'App\\Filament\\Tenant\\Resources\\Roles\\Pages\\EditRole',
        'as' => 'filament.tenant.resources.roles.edit',
        'namespace' => NULL,
        'prefix' => 'admin/roles',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.tenant.resources.users.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:tenant',
          1 => 'Stancl\\Tenancy\\Middleware\\InitializeTenancyByDomain',
          2 => 'Stancl\\Tenancy\\Middleware\\PreventAccessFromCentralDomains',
          3 => 'App\\Http\\Middleware\\EnsureTenantDatabase',
          4 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          5 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          6 => 'Illuminate\\Session\\Middleware\\StartSession',
          7 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          8 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          9 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          10 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          11 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          12 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          13 => 'Filament\\Http\\Middleware\\Authenticate',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Tenant\\Resources\\Users\\Pages\\ListUsers@__invoke',
        'controller' => 'App\\Filament\\Tenant\\Resources\\Users\\Pages\\ListUsers',
        'as' => 'filament.tenant.resources.users.index',
        'namespace' => NULL,
        'prefix' => 'admin/users',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.tenant.resources.users.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:tenant',
          1 => 'Stancl\\Tenancy\\Middleware\\InitializeTenancyByDomain',
          2 => 'Stancl\\Tenancy\\Middleware\\PreventAccessFromCentralDomains',
          3 => 'App\\Http\\Middleware\\EnsureTenantDatabase',
          4 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          5 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          6 => 'Illuminate\\Session\\Middleware\\StartSession',
          7 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          8 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          9 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          10 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          11 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          12 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          13 => 'Filament\\Http\\Middleware\\Authenticate',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Tenant\\Resources\\Users\\Pages\\CreateUser@__invoke',
        'controller' => 'App\\Filament\\Tenant\\Resources\\Users\\Pages\\CreateUser',
        'as' => 'filament.tenant.resources.users.create',
        'namespace' => NULL,
        'prefix' => 'admin/users',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.tenant.resources.users.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:tenant',
          1 => 'Stancl\\Tenancy\\Middleware\\InitializeTenancyByDomain',
          2 => 'Stancl\\Tenancy\\Middleware\\PreventAccessFromCentralDomains',
          3 => 'App\\Http\\Middleware\\EnsureTenantDatabase',
          4 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          5 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          6 => 'Illuminate\\Session\\Middleware\\StartSession',
          7 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          8 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          9 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          10 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          11 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          12 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          13 => 'Filament\\Http\\Middleware\\Authenticate',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Tenant\\Resources\\Users\\Pages\\EditUser@__invoke',
        'controller' => 'App\\Filament\\Tenant\\Resources\\Users\\Pages\\EditUser',
        'as' => 'filament.tenant.resources.users.edit',
        'namespace' => NULL,
        'prefix' => 'admin/users',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.tenant.resources.volunteer-registrations.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/volunteer-registrations',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:tenant',
          1 => 'Stancl\\Tenancy\\Middleware\\InitializeTenancyByDomain',
          2 => 'Stancl\\Tenancy\\Middleware\\PreventAccessFromCentralDomains',
          3 => 'App\\Http\\Middleware\\EnsureTenantDatabase',
          4 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          5 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          6 => 'Illuminate\\Session\\Middleware\\StartSession',
          7 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          8 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          9 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          10 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          11 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          12 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          13 => 'Filament\\Http\\Middleware\\Authenticate',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Tenant\\Resources\\VolunteerRegistrations\\Pages\\ListVolunteerRegistrations@__invoke',
        'controller' => 'App\\Filament\\Tenant\\Resources\\VolunteerRegistrations\\Pages\\ListVolunteerRegistrations',
        'as' => 'filament.tenant.resources.volunteer-registrations.index',
        'namespace' => NULL,
        'prefix' => 'admin/volunteer-registrations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.tenant.resources.volunteer-registrations.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/volunteer-registrations/create',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:tenant',
          1 => 'Stancl\\Tenancy\\Middleware\\InitializeTenancyByDomain',
          2 => 'Stancl\\Tenancy\\Middleware\\PreventAccessFromCentralDomains',
          3 => 'App\\Http\\Middleware\\EnsureTenantDatabase',
          4 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          5 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          6 => 'Illuminate\\Session\\Middleware\\StartSession',
          7 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          8 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          9 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          10 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          11 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          12 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          13 => 'Filament\\Http\\Middleware\\Authenticate',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Tenant\\Resources\\VolunteerRegistrations\\Pages\\CreateVolunteerRegistration@__invoke',
        'controller' => 'App\\Filament\\Tenant\\Resources\\VolunteerRegistrations\\Pages\\CreateVolunteerRegistration',
        'as' => 'filament.tenant.resources.volunteer-registrations.create',
        'namespace' => NULL,
        'prefix' => 'admin/volunteer-registrations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'filament.tenant.resources.volunteer-registrations.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/volunteer-registrations/{record}/edit',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'panel:tenant',
          1 => 'Stancl\\Tenancy\\Middleware\\InitializeTenancyByDomain',
          2 => 'Stancl\\Tenancy\\Middleware\\PreventAccessFromCentralDomains',
          3 => 'App\\Http\\Middleware\\EnsureTenantDatabase',
          4 => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
          5 => 'Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse',
          6 => 'Illuminate\\Session\\Middleware\\StartSession',
          7 => 'Filament\\Http\\Middleware\\AuthenticateSession',
          8 => 'Illuminate\\View\\Middleware\\ShareErrorsFromSession',
          9 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
          10 => 'Illuminate\\Routing\\Middleware\\SubstituteBindings',
          11 => 'Filament\\Http\\Middleware\\DisableBladeIconComponents',
          12 => 'Filament\\Http\\Middleware\\DispatchServingFilamentEvent',
          13 => 'Filament\\Http\\Middleware\\Authenticate',
        ),
        'excluded_middleware' => 
        array (
        ),
        'uses' => 'App\\Filament\\Tenant\\Resources\\VolunteerRegistrations\\Pages\\EditVolunteerRegistration@__invoke',
        'controller' => 'App\\Filament\\Tenant\\Resources\\VolunteerRegistrations\\Pages\\EditVolunteerRegistration',
        'as' => 'filament.tenant.resources.volunteer-registrations.edit',
        'namespace' => NULL,
        'prefix' => 'admin/volunteer-registrations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::u5EncYuhPSwQ9UXq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'livewire/livewire.js',
      'action' => 
      array (
        'uses' => 'Livewire\\Mechanisms\\FrontendAssets\\FrontendAssets@returnJavaScriptAsFile',
        'controller' => 'Livewire\\Mechanisms\\FrontendAssets\\FrontendAssets@returnJavaScriptAsFile',
        'as' => 'generated::u5EncYuhPSwQ9UXq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rqAUU17tAFCg4hj8' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'livewire/livewire.min.js.map',
      'action' => 
      array (
        'uses' => 'Livewire\\Mechanisms\\FrontendAssets\\FrontendAssets@maps',
        'controller' => 'Livewire\\Mechanisms\\FrontendAssets\\FrontendAssets@maps',
        'as' => 'generated::rqAUU17tAFCg4hj8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'livewire.upload-file' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'livewire/upload-file',
      'action' => 
      array (
        'uses' => 'Livewire\\Features\\SupportFileUploads\\FileUploadController@handle',
        'controller' => 'Livewire\\Features\\SupportFileUploads\\FileUploadController@handle',
        'as' => 'livewire.upload-file',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'livewire.preview-file' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'livewire/preview-file/{filename}',
      'action' => 
      array (
        'uses' => 'Livewire\\Features\\SupportFileUploads\\FilePreviewController@handle',
        'controller' => 'Livewire\\Features\\SupportFileUploads\\FilePreviewController@handle',
        'as' => 'livewire.preview-file',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'stancl.tenancy.asset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tenancy/assets/{path?}',
      'action' => 
      array (
        'uses' => 'Stancl\\Tenancy\\Controllers\\TenantAssetsController@asset',
        'controller' => 'Stancl\\Tenancy\\Controllers\\TenantAssetsController@asset',
        'as' => 'stancl.tenancy.asset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'path' => '(.*)',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4lh5cBaQIchIkZUj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'up',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:832:"function () {
                    $exception = null;

                    try {
                        \\Illuminate\\Support\\Facades\\Event::dispatch(new \\Illuminate\\Foundation\\Events\\DiagnosingHealth);
                    } catch (\\Throwable $e) {
                        if (app()->hasDebugModeEnabled()) {
                            throw $e;
                        }

                        report($e);

                        $exception = $e->getMessage();
                    }

                    return response(\\Illuminate\\Support\\Facades\\View::file(\'F:\\\\syncOut\\\\volunteer-platform\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Foundation\\\\Configuration\'.\'/../resources/health-up.blade.php\', [
                        \'exception\' => $exception,
                    ]), status: $exception ? 500 : 200);
                }";s:5:"scope";s:54:"Illuminate\\Foundation\\Configuration\\ApplicationBuilder";s:4:"this";N;s:4:"self";s:32:"0000000000000e380000000000000000";}}',
        'as' => 'generated::4lh5cBaQIchIkZUj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bRu8g80epjLamf8L' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'Stancl\\Tenancy\\Middleware\\InitializeTenancyByDomain',
          3 => 'Stancl\\Tenancy\\Middleware\\PreventAccessFromCentralDomains',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:66:"function () {
        return \'Tenant app: \' . \\tenant(\'id\');
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000e350000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::bRu8g80epjLamf8L',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'storage.local' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'storage/{path}',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:3:{s:4:"disk";s:5:"local";s:6:"config";a:5:{s:6:"driver";s:5:"local";s:4:"root";s:49:"F:\\syncOut\\volunteer-platform\\storage\\app/private";s:5:"serve";b:1;s:5:"throw";b:0;s:6:"report";b:0;}s:12:"isProduction";b:0;}s:8:"function";s:323:"function (\\Illuminate\\Http\\Request $request, string $path) use ($disk, $config, $isProduction) {
                    return (new \\Illuminate\\Filesystem\\ServeFile(
                        $disk,
                        $config,
                        $isProduction
                    ))($request, $path);
                }";s:5:"scope";s:47:"Illuminate\\Filesystem\\FilesystemServiceProvider";s:4:"this";N;s:4:"self";s:32:"0000000000000e360000000000000000";}}',
        'as' => 'storage.local',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'path' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'livewire.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'livewire/update',
      'action' => 
      array (
        'uses' => 'Livewire\\Mechanisms\\HandleRequests\\HandleRequests@handleUpdate',
        'controller' => 'Livewire\\Mechanisms\\HandleRequests\\HandleRequests@handleUpdate',
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'livewire.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
