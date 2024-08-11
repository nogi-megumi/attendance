<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_id',
        'break_start',
        'break_end'
    ];
    public function work()
    {
        return $this->belongsTo(Work::class);
    }
    public function isBreaking()
    {
        return $this->break_start && !$this->break_end;
    }
}
