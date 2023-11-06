<?php

namespace App\Http\Controllers\Dashboard\Core;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Department;
use App\Traits\imageTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;


class DepartmentController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            $department = Department::all();
            return DataTables::of($department)
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('employee_count', function ($row) {

                    return $row->employees->count();
                })
                ->addColumn('sum_salary', function ($row) {

                    return $row->employees->sum('salary');
                })
                ->addColumn('controll', function ($row) {

                    $html = '
                    <a href="' . route('dashboard.core.department.edit', $row->id) . '" class="mr-2 btn btn-primary btn-sm"><i class="far fa-edit"></i> </a>

                                <a data-href="' . route('dashboard.core.department.destroy', $row->id) . '" data-id="' . $row->id . '" class="mr-2 btn btn-danger btn-delete btn-sm">
                            <i class="far fa-trash-alt "></i>
                    </a>
                                ';

                    return $html;
                })
                ->rawColumns([
                    'title',
                    'employee_count',
                    'sum_salary',
                    'controll',
                ])
                ->make(true);
        }


        return view('dashboard.core.department.index');
    }

    public function create()
    {
        return view('dashboard.core.department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|String|min:3',
        ]);

        $data=$request->except('_token');

        $department = Department::updateOrCreate($data);
        session()->flash('success');
        return redirect()->route('dashboard.core.department.index');
    }

    public function edit($id)
    {
        $department = Department::where('id',$id)->first();
        return view('dashboard.core.department.edit', compact( 'department'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|String|min:3',
        ]);
        $data=$request->except('_token');

        $department = Department::find($id);

        $department->update($data);
        session()->flash('success');
        return redirect()->route('dashboard.core.department.index');
    }

    public function destroy($id)
    {
        $department = Department::find($id);

        if ($department->employees->count() > 0 ){
            return [
                'error' => true,
                'msg' => 'cannot delete this item'
            ];
        }
        $department->delete();
        return [
            'success' => true,
            'msg' => __("dash.deleted_success")
        ];
    }

}
