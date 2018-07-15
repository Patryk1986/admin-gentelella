## LiteCode - Admin Genterella

- - - -
Created from: https://github.com/puikinsh/gentelella

Official preview of Genterella: https://colorlib.com/polygon/gentelella/index.html

### Installation
````
    composer require lite-code/admingentelella
    php artisan vendor:publish --provider="LiteCode\Admingantellela\App\Providers\AdmingantellelaServiceProvider" /* --force */
    
    php artisan vendor:publish --provider="LiteCode\Admingantellela\App\Providers\AdmingantellelaServiceProvider" --tag="migrations"
    php artisan vendor:publish --provider="LiteCode\Admingantellela\App\Providers\AdmingantellelaServiceProvider" --tag="config"
    php artisan vendor:publish --provider="LiteCode\Admingantellela\App\Providers\AdmingantellelaServiceProvider" --tag="seeds"
    php artisan vendor:publish --provider="LiteCode\Admingantellela\App\Providers\AdmingantellelaServiceProvider" --tag="assets"
    
    // spatie/laravel-permission
    php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"
    php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"
    
    php artisan migrate --seed OR php artisan migrate:refresh --seed
    
    /* Not used yet
    php artisan db:seed --class=AdminTableSeeder
    php artisan db:seed --class=PermissionTableSeeder
    */
````

- - - -

#### This package includes guard:admin, login page, migration + seed table:admin, config:adminauth
After vendor:publish check configuration file in /config/adminauth.php

- - - - 

#### Artisan command for creating admin user with role "Super Admin":
```
php artisan lite:admin
```
#### Controllers middleware:
```
$this->middleware('auth:admin', ['except' => ['logout']]);
$this->middleware('role:Super Admin');
// multiple assingment roles per middleware
$this->middleware('role:Super Admin|Another Role|My Role');
```

- - - -

#### Extend admin views or override if you must
Use vendor package src/resources/views/backend for inspiration.
Path "/resources/views/backend/" has a namespace "admin", just create your "backend" folder and use it.
Use this in blade (ex: dashboard.blade.php)
````
@extends('admin::layouts.gentelella')

@section('content')
    {{'Your content here'}}
@endsection
````

- - - -

