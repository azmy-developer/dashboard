<?php

namespace App\Http\Controllers\Dashboard\Core;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Task\TaskRequest;
use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;


class TaskController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            $task = Task::all();
            return DataTables::of($task)
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('employee', function ($row) {

                    return $row->employee?->first_name;
                })
                ->addColumn('status', function ($row) {
                    $checked = '';
                    if ($row->active == 1) {
                        $checked = 'checked';
                    }
                    $html = '<input type="checkbox" id="switch3" data-id="' . $row->id . '" ' . $checked . ' switch="bool" />
                                                    <label for="switch3" data-on-label="Yes" data-off-label="No"></label>';
                    return $html;
                })
                ->addColumn('controll', function ($row) {

                    $html = '
                    <a href="' . route('dashboard.core.task.edit', $row->id) . '" class="mr-2 btn btn-primary btn-sm"><i class="far fa-edit"></i> </a>

                                <a data-href="' . route('dashboard.core.task.destroy', $row->id) . '" data-id="' . $row->id . '" class="mr-2 btn btn-danger btn-delete btn-sm">
                            <i class="far fa-trash-alt "></i>
                    </a>
                                ';

                    return $html;
                })
                ->rawColumns([
                    'title',
                    'employee',
                    'status',
                    'controll',
                ])
                ->make(true);
        }

        return view('dashboard.core.tasks.index');
    }

    public function create()
    {
        $employees = Employee::query()->whereHas( 'roles', function($q){ $q->where('name', 'employee'); })->get();
        return view('dashboard.core.tasks.create',compact('employees'));
    }

    public function store(TaskRequest $request)
    {
        $data=$request->except('_token');
        $model = Task::query()->Create($data);
        session()->flash('success');
        return redirect()->route('dashboard.core.task.index');
    }


    public function edit($id)
    {
        $model = Task::query()->where('id',$id)->first();
        $employees = Employee::query()->whereHas( 'roles', function($q){ $q->where('name', 'employee'); })->get();
        return view('dashboard.core.tasks.edit',compact('model','employees'));
    }

    public function update(TaskRequest $request, $id)
    {
        $data=$request->except('_token');

        $model = Task::query()->find($id);
        $model->update($data);

        session()->flash('success');
        return redirect()->route('dashboard.core.task.index');
    }


    public function destroy($id)
    {
        $user = Task::find($id);

        $user->delete();
        return [
            'success' => true,
            'msg' => __("dash.deleted_success")
        ];
    }

    public function change_status(Request $request)
    {
        $admin = Task::where('id', $request->id)->first();
        if ($request->active == 'true') {
            $active = 1;
        } else {
            $active = 0;
        }

        $admin->active = $active;
        $admin->save();
        return response()->json(['sucess' => true]);
    }
}
