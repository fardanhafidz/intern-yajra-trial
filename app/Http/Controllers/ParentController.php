<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ParentController extends Controller
{
    public function parent()
    {
        $jobs = User::distinct()->pluck('job');
        return view('parent', compact('jobs'));
    }

    public function getDataParent(Request $request)
    {
        $query = User::with('children');

        if ($request->get('filterByJob') != '') {
            $query = $query->where('job', $request->get('filterByJob'));
        }
        if ($request->get('filterByClass') != '') {
            $query = $query->where('classification', $request->get('filterByClass'));
        }
        $parentData = $query->get();

        return Datatables::of($parentData)
            ->addColumn('child', function (User $user) {
                return $user->children->count() . ' anak';
            })
            ->addColumn('age', function (User $user) {
                return $user->age() . ' tahun';
            })
            ->addColumn('class', function (User $user) {
                return $user->classification($user->age());
            })
            ->setRowClass(function (User $user) {
                return $user->children->count() > 4 ? 'table-warning' : 'table-white';
            })
            ->addColumn('image', function () {
                $url = asset('/image/image-dummy.jpg');
                return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
            })
            ->addColumn('action', 'action1')
            ->rawColumns(['image', 'action'])
            ->toJson();
    }

    public function exportPdf(Request $request)
    {

        $query = User::with('children');

        if ($request->filled('filterByJob')) {
            $query = $query->where('job', $request->get('filterByJob'));
        }
        if ($request->filled('filterByClass')) {
            $query = $query->where('classification', $request->get('filterByClass'));
        }
        $parentData = $query->limit(10)->get();
        $pdf = Pdf::loadview('parent-export-pdf', ['parents' => $parentData]);

        return $pdf->stream();
        return $pdf->download('data-parent.pdf');
    }

    public function testExportPdf(Request $request)
    {
        $query = User::with('children');

        if ($request->filled('filterByJob')) {
            $query = $query->where('job', $request->get('filterByJob'));
        }
        if ($request->filled('filterByClass')) {
            $query = $query->where('classification', $request->get('filterByClass'));
        }

        $parentData = $query->get();

        return view('parent-export-pdf', ['parents' => $parentData]);
    }
}
