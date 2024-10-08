<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_start',
        'work_end',
    ];
    public function breakTimes()
    {
        return $this->hasMany(BreakTime::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function isWorking()
    {
        return $this->work_start && !$this->work_end;
    }
    public function isnotWorking()
    {
        return $this->work_end;
    }
}
