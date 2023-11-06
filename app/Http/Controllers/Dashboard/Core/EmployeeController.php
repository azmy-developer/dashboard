<?php

namespace App\Http\Controllers\Dashboard\Core;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Employee\EmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Support\Traits\imageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;


class EmployeeController extends Controller
{
    use imageTrait;

    public function index()
    {

        if (request()->ajax()) {
            $user = Employee::all();
            return DataTables::of($user)
                ->addColumn('name', function ($user) {
                    $name = $user->first_name . ' ' . $user->last_name;
                    return $name;
                })->addColumn('salary', function ($user) {
                    return $user->salary;
                })->addColumn('image', function ($row) {
                    return '<img class="img-fluid" style="width: 85px;" src="'.asset($row->image).'"/>';
                })
                ->addColumn('status', function ($user) {
                    $checked = '';
                    if ($user->active == 1) {
                        $checked = 'checked';
                    }
                    $html = '<input type="checkbox" id="switch3" data-id="' . $user->id . '" ' . $checked . ' switch="bool" />
                                                    <label for="switch3" data-on-label="Yes" data-off-label="No"></label>';
                    return $html;
                })
                ->addColumn('controll', function ($user) {

                    $html = '
                    <a href="' . route('dashboard.employee.edit', $user->id) . '" class="mr-2 btn btn-primary btn-sm"><i class="far fa-edit"></i> </a>

                                <a data-href="' . route('dashboard.employee.destroy', $user->id) . '" data-id="' . $user->id . '" class="mr-2 btn btn-danger btn-delete btn-sm">
                            <i class="far fa-trash-alt "></i>
                    </a>
                                ';

                    return $html;
                })
                ->rawColumns([
                    'name',
                    'status',
                    'salary',
                    'image',
                    'controll',
                ])
                ->make(true);
        }

        return view('dashboard.core.employees.index');
    }

    public function create()
    {
        $roles = Role::query()->where('guard_name', 'employee')->get();
        $departments = Department::query()->get();

        return view('dashboard.core.employees.create',compact('roles','departments'));
    }

    public function store(EmployeeRequest $request)
    {
        $data=$request->except('_token','password_confirmation','role','avatar');
        if ($request->has('avatar')){
            $image=$this->storeImages($request->avatar,'employee');
            $data['image']= 'storage/images/employee'.'/'.$image;
        }
        $model = Employee::query()->Create($data);
        $model->assignRole($request->role);
        session()->flash('success');
        return redirect()->route('dashboard.employee.index');
    }


    public function edit($id)
    {
        $model = Employee::query()->where('id',$id)->first();
        $roles = Role::query()->where('guard_name', 'employee')->get();
        $departments = Department::query()->get();

        return view('dashboard.core.employees.edit',compact('model','roles','departments'));
    }

    public function update(EmployeeRequest $request, $id)
    {
        $data=$request->except('_token','password_confirmation','role','avatar');

        $model = Employee::query()->find($id);

        if ($request->has('avatar')){
            if (File::exists(public_path($model->image))) {
                File::delete(public_path($model->image));
            }
            $image=$this->storeImages($request->avatar,'employee');
            $data['image']= 'storage/images/employee'.'/'.$image;
        }

        $model->update($data);

        $model->syncRoles($request->role);

        session()->flash('success');
        return redirect()->route('dashboard.employee.index');
    }


    public function destroy($id)
    {
        $user = Employee::find($id);

        $user->delete();
        return [
            'success' => true,
            'msg' => __("dash.deleted_success")
        ];
    }

    public function change_status(Request $request)
    {
        $admin = Employee::where('id', $request->id)->first();
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
