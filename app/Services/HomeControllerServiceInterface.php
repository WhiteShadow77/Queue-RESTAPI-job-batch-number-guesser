<?php


namespace App\Services;

use App\Library\BatchHandler;
use App\Library\BatchHandlerInterface;
use Illuminate\Http\Request;

interface HomeControllerServiceInterface
{
    public function show(Request $request);
    public function start(Request $request);
    public function clear();
    public function batchInfo();
    public function batchCancel();
}
