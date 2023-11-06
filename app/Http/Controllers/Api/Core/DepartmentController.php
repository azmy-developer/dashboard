<?php

namespace App\Http\Controllers\Api\Core;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\DepartmentResource;
use App\Models\Department;
use App\Support\Api\ApiResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    use ApiResponse;

    protected function index()
    {
        $department = Department::query()->get();
        $this->body['department'] = DepartmentResource::collection($department);
        return self::apiResponse(200, null, $this->body);
    }

    protected function store(Request $request)
    {
        $request->validate([
            'title' => 'required|String|min:3',

        ]);
        $data = $request->except('_token');


        $department = Department::query()->create($data);

        $this->body['department'] = DepartmentResource::make($department);
        return self::apiResponse(200, null, $this->body);

    }

    protected function update(Request $request, $id)
    {
        $department = Department::find($id);
        if ($department) {
            $request->validate([
                'title' => 'required|String|min:3',
            ]);
            $data = $request->except('_token');
            $department->update($data);
            $this->body['department'] = DepartmentResource::make($department);
            return self::apiResponse(200, null, $this->body);
        } else {
            return self::apiResponse(400, __('api.not found'), $this->body);
        }

    }

    protected function delete($id)
    {
        $department = Department::find($id);
        if ($department) {
            $department->delete();
            return self::apiResponse(200, null, $this->body);
        } else {
            return self::apiResponse(200, __('api.not found or already deleted'), $this->body);
        }

    }
}
