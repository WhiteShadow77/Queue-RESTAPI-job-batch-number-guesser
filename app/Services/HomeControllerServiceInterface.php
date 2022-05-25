<?php


namespace App\Services;


use Illuminate\Http\Request;

interface HomeControllerServiceInterface
{
    public function show(Request $request);
    public function start(Request $request);
    public function clear();
    public function batchInfo();
    public function batchCancel();
}
