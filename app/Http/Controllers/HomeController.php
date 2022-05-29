<?php

namespace App\Http\Controllers;

use App\Library\BatchHandlerInterface;
use App\Services\HomeControllerServiceInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $queueControllerService;

    public function __construct(
        HomeControllerServiceInterface $queueControllerService
    ) {
        $this->queueControllerService = $queueControllerService;
    }

    public function show(Request $request)
    {
        return $this->queueControllerService->show($request);
    }

    public function start(Request $request)
    {
        return $this->queueControllerService->start($request);
    }

    public function clear()
    {
        return $this->queueControllerService->clear();
    }

    public function info()
    {
        return $this->queueControllerService->info();
    }

    public function cancel()
    {
        return $this->queueControllerService->cancel();
    }
}
