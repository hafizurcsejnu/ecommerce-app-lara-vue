<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('login');   
    }

    // public function registration(Request $request)
    // {
    //     $contact = new User();
    //     $contact->name = $request->name;
    //     $contact->email = $request->email;
    //     $contact->password = $request->password;
    //     $contact->save();

    //     return response()->json([
    //         'message' => 'User Created Successfully',
    //         'code' => 200
    //     ]);
    // }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if(!$token = JWTAuth::attempt($credentials)){
            return response()->json(['success'=>false, 'status'=>401]);
        }

        $user = User::where('email', $request->email)->first();
        $user_type = $user->user_type;
        //$user_type = checkUserType($request->email);

        return response()->json(['success'=>true, 'token'=>$token, 'user_type'=>$user_type, 'status'=>200]);
        //return response()->json(['success'=>true, 'token'=>$token], 200);
    }
    public function checkUserType($email){
        $user = User::find($email);
        $user_type = $user->user_type;
        return response()->json($user_type);
    }
    public function checkToken(){
        return response()->json(['success'=>true], 200);
    }

    public function logout(){
        $logout = auth()->logout();
        return response()->json(['success'=>true, 'status'=>200]);
    }
}
