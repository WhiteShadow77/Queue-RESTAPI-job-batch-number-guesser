<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FailedJobEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public int $randNumber;
    public int $guessNumber;
    public int $transaction;
    public int $paramId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($randNumber, $guessNumber, $transaction, $paramId)
    {
        $this->randNumber = $randNumber;
        $this->guessNumber = $guessNumber;
        $this->transaction = $transaction;
        $this->paramId = $paramId;
    }
}
