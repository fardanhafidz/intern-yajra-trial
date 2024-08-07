<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class ChildController extends Controller
{
    public function showChild($id)
    {
        $children = User::findOrFail($id);
        return view('show-children', compact('children', 'id'));
    }

    public function getDataChild($id)
    {
        $parent = User::with('children')->findOrFail($id);
        $child = $parent->children;

        return DataTables::of($child)
            ->make(true);
    }
}
