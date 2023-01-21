<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reg_no'
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function registrations() {
        return $this->hasMany(Registration::class);
    }
}
