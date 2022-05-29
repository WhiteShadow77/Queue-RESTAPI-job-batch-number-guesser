<?php

namespace App\Jobs;

use App\Events\FailedExceptionEvent;
use App\Events\FailedJobEvent;
use App\Events\SuccessJobEvent;
use App\Models\Param;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GuessJob implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $args = [];
    protected int $transaction;
    protected int $randNumber;
    protected int $idParam;
    public $tries = 100;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($args)
    {
        $this->args = $args;
        $this->tries = $this->args['tries'];
        $param = Param::create([
            'params' => json_encode($this->args),
            'startDateTime' => date("Y-m-d H:i:s")
        ]);
        $this->idParam = $param->id;
        $this->transaction = time() + $param->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->batch()->cancelled()) {
            return;
        }

        $this->randNumber = mt_rand(
            $this->args['range']['start'],
            $this->args['range']['end']
        );
        if ($this->randNumber != $this->args['guessNumber']) {
            event(new FailedJobEvent(
                $this->randNumber,
                $this->args['guessNumber'],
                $this->transaction,
                $this->idParam
            ));
            $message = [
                'message' => 'Failed. ' . $this->randNumber . ' is not ' . $this->args['guessNumber'],
                'transaction' => $this->transaction,
                'guessNumber' => $this->args['guessNumber'],
                'randNumber' => $this->randNumber,
                'idParam' => $this->idParam
            ];
            throw new Exception(json_encode($message, true));
        } else {
            event(new SuccessJobEvent(
                $this->randNumber,
                $this->args['guessNumber'],
                $this->transaction,
                $this->idParam
            ));
        }
    }

    public function failed(Exception $exception)
    {
        event(new FailedExceptionEvent($exception));
    }

    public function backoff()
    {
        return $this->args['backoff'];
    }
}
