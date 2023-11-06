<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ChangePasswordRequest;
use App\Http\Requests\Api\Auth\ForgetPasswordRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\ProfileUpdateRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\User\EmployeeResource;
use App\Http\Resources\User\UserResource;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use App\Sms\HiSms;
use App\Support\Api\ApiResponse;
use App\Traits\SMSTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use MoemenGaballah\Msegat\Msegat;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|numeric|unique:employees,phone',
            'password' => ['required','regex:/^(?=.*[A-Za-z])(?=.*\d)/' ,Password::min(4)],
        ], $request->all());

        $cred = ['phone' => $request['phone'], 'password' => $request['password']];

        if (Auth::guard('employee')->attempt($cred)) {

            $employee = Auth::guard('employee')->user();

            $this->message = __('api.login successfully');
            $this->body['user'] = EmployeeResource::make($employee);
            $this->body['accessToken'] = $user->createToken('employee-token')->plainTextToken;

            return self::apiResponse(200, $this->message, $this->body);


        } else {
            return self::apiResponse(200,'Incorrect Phone Or Password', []);
        }

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

        return self::apiResponse(200, $this->message, $this->body);

    }
    }
