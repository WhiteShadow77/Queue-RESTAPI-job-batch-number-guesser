<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StartBatchEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public array $chain;

    public function __construct(array $chain)
    {
        $this->chain = $chain;
    }
}
