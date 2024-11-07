<?php
  
namespace App\Http\Controllers;
  
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

  
class AuthController extends Controller
{
 
    public function register() {
        $validator = Validator::make(request()->all(), [
            'full_name' => 'required',
            'username' => 'required|min:3|unique:users',
            'password' => 'required|min:6',
        ],
        [
            'full_name.required' => 'The full name field is required',
            'username.unique' => 'The username has already been taken',
            'password.required' => 'The password field is required',
        ]);
  
        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid field(s) in request',
                'errors' => $validator->errors()->toJson()
            ], 400);
        }
  
        $user = new User;
        $user->full_name = request()->full_name;
        $user->username = request()->username;
        $user->password = bcrypt(request()->password);
        $role = "user";
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken; 
  
        return response()->json([
            'message' => 'User registration successfuly',
            'status' => 'success',
            'data' => [
                'full_name' => $user->full_name,
                'username' => $user->username,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'id' => $user->id,
                'token' => $token,
                'role' =>  $role
            ],
        ], 201);
    }
  
  
    public function login(Request $request)
    {
        if (! Auth::attempt($request->only('username', 'password'))) {
            return response()->json([
                'status' => 'authentication_failed',
                'message' => "The username or password you entered is incorrect",
            ], 400);
        }
        
        $user = User::where('username', $request->username)->firstOrFail();



        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => [
                'id' => $user->id,
                'username' => $user->username,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'role' => 'admin',
                'token' => $token,
            ],
        ]);
    }


    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Logout successful'
        ], 200);
    }
}