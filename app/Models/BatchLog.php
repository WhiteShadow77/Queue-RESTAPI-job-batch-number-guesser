<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchLog extends Model
{
    use HasFactory;

    protected $table = 'batch_logs';

    protected $fillable = [
        'result',
        'result_id'
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
