<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userfe extends Model
{
    protected $table ='usersfe';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

}
