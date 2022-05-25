<?php

namespace App\Listeners;

use App\Events\StartBatchEvent;
use App\Models\BatchLog;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Throwable;

class StartBatchListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\StartBatchEvent  $event
     * @return void
     */
    public function handle(StartBatchEvent $event)
    {
        $batch = Bus::batch($event->chain)
            ->then(function (Batch $batch) {
                // Все задания успешно завершены ...
                BatchLog::create([
                    'result' => 'All OK',
                    'batchId' => \App\Models\Batch::where('id_batch','=', $batch->id)->first()->id
                ]);
            })->catch(function (Batch $batch, Throwable $e) {
                // Обнаружено первое проваленное задание из пакета ...
                BatchLog::create([
                    'result' => 'Failed, '. $e->getMessage(),
                    'batchId' => \App\Models\Batch::where('id_batch','=', $batch->id)->first()->id
                ]);
            })->finally(function (Batch $batch) {
                // Завершено выполнение пакета ...
                BatchLog::create([
                    'result' => 'Batch finished',
                    'batchId' => \App\Models\Batch::where('id_batch','=', $batch->id)->first()->id
                ]);
            })->dispatch();

        session(['batchId' => $batch->id]);
    }
}
