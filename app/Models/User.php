<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{   use HasFactory,Notifiable;
    protected $fillable = [
        "name","email","password","status","is_admin","verification_token","verified_at"];
    public function EmailVerfication(){
        return $this->hasOne(EmailVerification::class,"user_id","id");
    }
}
