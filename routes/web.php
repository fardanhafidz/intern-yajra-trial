<?php

use App\Models\Child;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

Route::get('/', function () {
    return view('parent');
})->name('tableParent');

Route::get('/data', function () {
    $parentData = DB::table('users')
        ->join('users', 'children.parent_id', '=', 'users.id')
        ->select(['children.*', 'users.name as parent_name']);
    return Datatables::of($parentData)
        ->filterColumn('parent_name', function ($query, $keyword) {
            $query->where('users.name', 'like', "%{$keyword}%");
        })
        ->addColumn('action', 'action')
        ->toJson();
})->name('data');

Route::get('/{id}/edit-data', function ($id) {
    dd('Edit data dengan id: ' . $id);
})->name('editData');

////////////////////////////////

Route::get('/child', function () {
    return view('child');
})->name('tableChild');

Route::get('/child-data', function () {
    $childData = DB::table('children')
        ->join('users', 'children.parent_id', '=', 'users.id')
        ->select(['children.*', 'users.name as parent_name']);
    return Datatables::of($childData)
        ->filterColumn('parent_name', function ($query, $keyword) {
            $query->where('users.name', 'like', "%{$keyword}%");
        })
        ->addColumn('action', 'action')
        ->make(true);
})->name('childData');
