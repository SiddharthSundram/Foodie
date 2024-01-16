<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User As Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name','email', 'password'];

    
}
