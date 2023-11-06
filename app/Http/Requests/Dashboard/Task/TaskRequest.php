<?php

namespace App\Http\Requests\Dashboard\Task;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class TaskRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {

        $rules = [
            'title' => 'required|string|max:100',
            'employee_id' => 'required|exists:employees,id',
            'active' => 'nullable',
        ];

        return $rules;
    }
}
