<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_model extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password'
    ];
}
