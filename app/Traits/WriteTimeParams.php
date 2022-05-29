<?php

namespace App\Traits;

use App\Models\Param;
use Carbon\Carbon;

trait WriteTimeParams
{
    public function writeTimeParams(int $idParam)
    {
        $param = Param::find($idParam);
        $param->endDateTime = date("Y-m-d H:i:s");
        $param->save();

        $startDateTime = Param::find($idParam)->startDateTime;
        $endDateTime = Param::find($idParam)->endDateTime;
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startDateTime);
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $endDateTime);

        $param->completionTime = $endDateTime->diffInSeconds($startDateTime);
        $param->save();
    }
}
