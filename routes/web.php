<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return [
        'message' => 'Filament Starter Kit v1.0 by Ermuun Erdenekhuyag',
    ];
});
