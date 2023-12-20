<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id","is_verified","token","expired_at"];
    public function User()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }
}
