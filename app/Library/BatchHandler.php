<?php


namespace App\Library;


use App\Models\BatchLog;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Throwable;

class BatchHandler
{
    public function setBatch(array $chain)
    {
        $batch = Bus::batch($chain)
            ->then(function (Batch $batch) {
                // Все задания успешно завершены ...
                BatchLog::create([
                    'result' => 'All OK',
                    'result_id' => \App\Models\Batch::where('id_batch','=', $batch->id)->first()->id
                ]);
            })->catch(function (Batch $batch, Throwable $e) {
                // Обнаружено первое проваленное задание из пакета ...
                BatchLog::create([
                    'result' => 'Failed, '. $e->getMessage(),
                    'result_id' => \App\Models\Batch::where('id_batch','=', $batch->id)->first()->id
                ]);
            })->finally(function (Batch $batch) {
                // Завершено выполнение пакета ...
                BatchLog::create([
                    'result' => 'Batch finished',
                    'result_id' => \App\Models\Batch::where('id_batch','=', $batch->id)->first()->id
                ]);
            })->dispatch();

        return $batch->id;
    }
}
