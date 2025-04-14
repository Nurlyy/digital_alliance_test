<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class TaskResource extends JsonResource
{
    public function toArray($request): array
    {
        $deadline = $this->deadline;
        $daysUntilDeadline = now()->diffInDays($deadline, false);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'importance' => $this->importance,
            'deadline' => $deadline,
            'is_overdue' => $daysUntilDeadline < 0,
            'priority_score' => $daysUntilDeadline > 0 ? $this->importance * (1 / $daysUntilDeadline) : 0,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
