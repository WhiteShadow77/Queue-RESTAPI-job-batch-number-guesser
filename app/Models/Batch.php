<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'progress',
        'id_batch',
        'links',
        'successed',
        'failed',
        'finished',
        'canceled'
    ];

    public function logs()
    {
        return $this->hasMany(BatchLog::class);
    }
}
