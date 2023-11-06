<?php

namespace App\Http\Controllers\Api\Core;

use App\Http\Controllers\Controller;
use App\Http\Resources\Task\TaskResource;
use App\Models\Department;
use App\Models\Task;
use App\Support\Api\ApiResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ApiResponse;

    protected function index()
    {
        $task = Task::query()->paginate(10);
        $this->body['task'] = TaskResource::collection($task)->response()->getData();
        return self::apiResponse(200, null, $this->body);
    }

    protected function store(Request $request)
    {
        $request->validate([
            'title' => 'required|String|min:3',
            'employee_id' => 'required|exists:employees,id',
            'active' => 'boolean|between:0,1',

        ]);
        $data = $request->except('_token');


        $task = Task::query()->create($data);

        $this->body['task'] = TaskResource::make($task);
        return self::apiResponse(200, null, $this->body);

    }

    protected function update(Request $request, $id)
    {
        $task = Task::find($id);
        if ($task) {
            $request->validate([
                'title' => 'required|String|min:3',
                'employee_id' => 'required|exists:employees,id',
                'active' => 'boolean|between:0,1',

            ]);
            $data = $request->except('_token');
            $task->update($data);
            $this->body['task'] = TaskResource::make($task);
            return self::apiResponse(200, null, $this->body);
        } else {
            return self::apiResponse(400, __('api.not found'), $this->body);
        }

    }

    protected function destroy($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->delete();
            return self::apiResponse(200, null, []);
        } else {
            return self::apiResponse(200, __('api.not found or already deleted'),[]);
        }

    }
}
