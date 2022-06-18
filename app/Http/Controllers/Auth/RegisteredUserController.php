<?php

namespace App\Http\Controllers\Auth;

use App\Mail\Verify;
use App\Models\User;
use App\Models\VerifyUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            "password"=>"required|min:6",
            'password_confirmation' => 'required:password|same:password',
        ]);

        $user = User::create([
            'name'          => $request->name,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'phone'         => $request->phone,
            'role_type'     => $request->role_type,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
        ]);

        //create verify users
        VerifyUsers::create([
            'user_id' => $user->id,
            'token' => sha1(time())
        ]);
        return response()->json(['status'=>true,'message'=>'Register Successfull']);
    }

    public function reset_password(Request $request){
        $validation=Validator($request->all(),[
            "password"=>"required|min:6",
            'password_confirmation' => 'required:password|same:password'
        ]);
        if($validation->fails()){
            return response()->json(['validation'=>$validation->getMessageBag()]);
        }
        $verify = VerifyUsers::where("token",$request->token)->first();
        User::where('id',$verify->user_id)->update(
            [
                "password"=>bcrypt($request->password)
            ]
        );
        VerifyUsers::where('token',$request->token)->delete();
        return response()->json(['success'=>'Reset password Successfull']);
    }

    public function forgot_password(Request $request){
        $user = User::where('email',$request->email)->first();
        if($user)
        {
            $verifyUser = VerifyUsers::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);

            \Mail::to($request->email)->send(new Verify($verifyUser));
            return response()->json(['success'=>'Send Meseges Success']);
        }else{
            return false;
        }
    }

    public function verifyToken($token)
    {
        $verifyUser = VerifyUsers::where('token', $token)->first();
        if($verifyUser){
            return $verifyUser->user_id;
        }
        return false;
    }
}
