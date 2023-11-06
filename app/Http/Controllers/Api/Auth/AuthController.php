<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\Dashboard\Employee\EmployeeRequest;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Employee;
use App\Support\Api\ApiResponse;
use App\Support\Traits\imageTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    use ApiResponse , imageTrait;

    public function login(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required',
            'password' => ['required',Password::min(4)],
        ], $request->all());

        $cred = ['phone' => $request['phone'], 'password' => $request['password']];

        if (Auth::guard('employee')->attempt($cred)) {

            $employee = Auth::guard('employee')->user();

            $this->message = __('api.login successfully');
            $this->body['employee'] = EmployeeResource::make($employee);
            $this->body['accessToken'] = $employee->createToken('employee-token')->plainTextToken;

            return self::apiResponse(200, $this->message, $this->body);


        } else {
            return self::apiResponse(200,'Incorrect Phone Or Password', []);
        }

    }

    public function register(Request $request)
    {

        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:employees,email',
            'phone' => 'required|numeric|unique:employees,phone',
            'password' => ['required','regex:/^(?=.*[A-Za-z])(?=.*\d)/' ,Password::min(4)],
            'active' => 'nullable',
            'role' => 'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ], $request->all());

        $data=$request->except('_token','role','image','password');

        if ($request->has('image')){
            $image=$this->storeImages($request->image,'employee');
            $data['image']= 'storage/images/employee'.'/'.$image;
        }

        $data['password'] = Hash::make($request->password);

        $employee = Employee::query()->Create($data);
        $employee->assignRole($request->role);

        $this->message = __('api.register successfully');
        $this->body['employee'] = EmployeeResource::make($employee);

        return self::apiResponse(200, $this->message, $this->body);

    }



        public function logout(Request $request)
        {
            auth()->user('employee')->tokens()->delete();
            $this->message = __('api.Logged out');

            return self::apiResponse(200, $this->message, $this->body);

        }


    public function deleteAccount(Request $request)
    {
        $user =  auth('employee')->user();
        $user->delete();
        $this->message = __('api.Delete user successfully');

        return self::apiResponse(200, $this->message, []);

    }
    }
