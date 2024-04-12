<?php

namespace App\Http\Resources\ImportTask;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImportTaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'statusName' => $this->getStatusName(),
            'statusId' => $this->status,
            'created_at' => $this->created_at->format('Y.m.d H:i'),
            'finished_at' => $this?->finished_at?->format('Y.m.d H:i'),
            'success_count' => $this?->success_count,
            'errors_count' => $this?->errors_count,
        ];
    }
}
