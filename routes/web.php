<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{id}/edit-data', function ($id) {
    dd('Edit data dengan id: ' . $id);
})->name('editData');

Route::get('/get-data', function () {
    return DataTables::of(User::query())
        ->addColumn('action', 'action')
        ->make(true);
})->name('getData');
