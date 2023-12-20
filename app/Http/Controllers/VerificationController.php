<?php

namespace App\Http\Controllers;

use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VerificationController extends Controller
{
    public function verify($token)
    {
        $user = User::where('verification_token', $token)->first();
        $verified=EmailVerification::where('user_id',$user->id)->first();
        if ($user) {

            $date= $user->verified_at=Carbon::now();
            if ($date<$verified->expired_at){
                $user->update(['status' => true,'verified_at'=>$date]);
                $verified->update(['is_verified'=>true]);
                return view('Auth.verifictaionSuccess');
            }
            return redirect('register');
        } else {
            return redirect('register');
        }
    }
}
