<?php

namespace App\Http\Controllers;

use App\Mail\MailVerify;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            return Auth::user()->is_admin? redirect('AdminDashboard') : redirect('UserDashboard');
        }

        return view("Auth.registerPage");

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $token=Str::random(5);
        $data= $request->validate([
            'name'=>'required',
            'email'=> 'required',
            'password'=> 'required'

        ]);
        $userExist=User::find($data['email']);
        if($userExist){
            return back()->with('status','Error!! Email Already Exist');
        }

        $user=User::create([
            'name'=> $data['name'],
            'email'=> $data['email'],
            'password'=> Hash::make($data['password']),
            'is_admin'=>false,
            'status'=>false,
            'verification_token'=> $token,
        ]);
        $user->status=false;
        $verified=EmailVerification::create([
            'user_id' => $user->id,
            'is_verified' => $user->status,
            'token'=>$token,
            'expired_at'=>Carbon::now()->addMinute()
        ]);

        Mail::to($user->email)->send(new MailVerify($user));
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    { $request->validate([
        'email'=> 'required',
        'password'=> 'required'
    ]);
        $userCredential=$request->only('email','password');
        if(Auth::attempt($userCredential)){

            if(Auth::user()->is_admin==true){
                session()->put('name',$request->name);
                return redirect('AdminDashboard')->with('status', 'Admin Logged in!');

            }
            else{
                $user = User::where('email',$request->email)->first();
                session()->put('id',$user->id);
                session()->put('name',$request->name);
                return redirect('UserDashboard')->with('status', 'User Logged in!');


            }
        }else{
            return back()->with('status','Error!! Wrong Input');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        session()->forget('id');
        session()->forget('name');
        Auth::logout();
        return redirect('/');
    }
}
