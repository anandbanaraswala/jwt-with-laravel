<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courses_model extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'courses';
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'total_videos'
    ];
}
