<?php

namespace App\Events;

use Exception;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FailedExceptionEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public Exception $exception;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
    }
}
