<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use JWTAuth;

class AuthController extends Controller {
    public function register(Request $r){
        $r->validate(['name'=>'required','email'=>'required|email|unique:users','password'=>'required|min:6','role_id'=>'required']);
        $user = User::create([
            'name'=>$r->name, 'email'=>$r->email, 'password'=>Hash::make($r->password), 'role_id'=>$r->role_id
        ]);
        $token = auth()->login($user);
        return response()->json(['token'=>$token,'user'=>$user]);
    }

    public function login(Request $r){
        $credentials = $r->only('email','password');
        if(!$token = auth()->attempt($credentials)){
            return response()->json(['error'=>'Invalid credentials'],401);
        }
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token){
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth()->factory()->getTTL()*60
        ]);
    }

    public function me(){ return response()->json(auth()->user()); }
    public function logout(){ auth()->logout(); return response()->json(['message'=>'Logged out']); }
}
