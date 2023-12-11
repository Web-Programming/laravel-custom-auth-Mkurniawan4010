<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Controllers\api\BaseController as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'level' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, "User register successfully.");
    }

    public function login(Request $request)
    {
        // if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        //     $user = Auth::user();
        //     $success['token'] = $user->createToken('MyApp')->plainTextToken;
        //     $success['name'] = $user->name;

        //     return $this->sendResponse($success, 'User login successfully.');
        // } else {
        //     return $this->sendError('Unauthorised', ['error' => 'Unauthorised']);
        // }

      $validator = Validator::make($request->all(), [
        'username' => 'required',
        'password' => 'required',
        'device_name' => 'required',
    ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

    $user = User::where('username', $request->username)->first();

    if (! $user || ! hash::check($request->password, $user->password)) {
        return $this->sendError('Validation Error', 'The provideed credentials are incorrect.');
        // throw ValidationException::withMessages([
        //     'username' => ['The provided credentials are incorrect.'],
        // ]);
    }
    $success['token'] = $user->createToken($request->device_name)->plainTextToken;
    $success['name'] = $user->name;
    return $this->sendResponse($success, 'User login successfully.');
    }
}
