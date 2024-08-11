<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'work_start',
        'work_end',
    ];
    public function works(){
        return $this->hasMany('App\Models\Break');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function isWorking()
    {
        return $this->work_start && !$this->work_end;
    }
}
