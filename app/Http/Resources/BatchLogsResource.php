<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BatchLogsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->canceled) {
            $status = 'canceled';
        } else {
            if ($this->finished) {
                $status = 'finished';
            } else {
                $status = 'in process';
            }
        }
        return [
            'id' => $this->id,
            'batch_id' => $this->id_batch,
            'progress' => $this->progress,
            'links' => $this->links,
            'successed' => $this->successed,
            'failed' => $this->failed,
            'status' => $status,
        ];
    }
}
