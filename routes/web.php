<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/get-data', function () {
    return DataTables::of(User::query())->make(true);
})->name('getData');
