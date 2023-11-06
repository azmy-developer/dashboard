<?php

namespace App\Http\Controllers\Api\Core;

use App\Http\Controllers\Controller;
use App\Http\Resources\Department\DepartmentResource;
use App\Models\Department;
use App\Support\Api\ApiResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    use ApiResponse;

    protected function index()
    {
        $department = Department::query()->paginate(10);
        $this->body['department'] = DepartmentResource::collection($department)->response()->getData();
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

    protected function destroy($id)
    {
        $department = Department::find($id);
        if ($department) {

            if ($department->employees->count() > 0 ){
                return self::apiResponse(200, 'cannot delete this item', []);

            }
            $department->delete();
            return self::apiResponse(200, null, []);
        } else {
            return self::apiResponse(200, __('api.not found or already deleted'), []);
        }

    }
}
