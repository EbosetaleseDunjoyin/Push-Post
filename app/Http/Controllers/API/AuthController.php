<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    // Register api
    public function register(Request $request): JsonResponse
    {
        try{

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User register successfully.');
        }catch(Exception $e){
            Log::error($e->getMessage());
            return $this->sendError('Issue Occured', $e->getMessage());
        }
    }

    // Login api
    public function login(Request $request): JsonResponse
    {
        try{
            if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){
                $user = Auth::user();
                $success['token'] =  $user->createToken('MyApp')->plainTextToken;
                $success['name'] =  $user->name;

                return $this->sendResponse($success, 'User login successfully.');
            }
            else{
                return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
            }
        }catch(Exception $e){
            Log::error($e->getMessage());
            return $this->sendError('Issue Occured', $e->getMessage());
        }
    }
}
