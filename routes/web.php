<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GroupController::class, 'index']);

Route::resource('groups', GroupController::class)->only([
    'index', 'create', 'store', 'show',
]);

Route::resource('groups.students', StudentController::class)->only([
    'create', 'store', 'show',
]);
