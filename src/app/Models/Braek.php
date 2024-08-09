<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Braek extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'work_id',
        'break_start',
        'break_end'
    ];
}
