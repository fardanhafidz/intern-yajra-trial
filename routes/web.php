<?php

use App\Http\Controllers\ChildController;
use App\Http\Controllers\ParentController;
use App\Models\Child;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

Route::get('/', [ParentController::class, 'parent'])->name('parent');
Route::get('/data', [ParentController::class, 'getDataParent'])->name('data');

Route::get('/export-pdf', [ParentController::class, 'exportPdf'])->name('exportPdf');
Route::get('/test-export-pdf', [ParentController::class, 'testExportPdf'])->name('testExportPdf');

Route::get('/{id}/edit-data', function ($id) {
    dd('Edit data dengan id: ' . $id);
})->name('editData');

Route::get('/{id}/children', [ChildController::class, 'showChild'])->name('showChildren');
Route::get('/{id}/children-data', [ChildController::class, 'getDataChild'])->name('getDataChild');

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
        ->addColumn('action', 'edit')
        ->make(true);
})->name('childData');
