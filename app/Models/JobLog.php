<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction',
        'guessNumber',
        'randNumber',
        'status',
        'param_id',
        'result_id'
    ];

    public function param()
    {
        return $this->belongsTo(Param::class);
    }
}
