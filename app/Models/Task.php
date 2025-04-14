<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Task",
 *     type="object",
 *     required={"title", "status", "importance", "deadline"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Срочная задача"),
 *     @OA\Property(property="description", type="string", example="Описание задачи"),
 *     @OA\Property(property="status", type="string", enum={"TODO", "IN_PROGRESS", "COMPLETED"}),
 *     @OA\Property(property="importance", type="integer", example=5),
 *     @OA\Property(property="deadline", type="string", format="date-time", example="2024-12-01T12:00:00"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 *     @OA\Property(property="is_overdue", type="boolean", example=false),
 *     @OA\Property(property="priority_score", type="number", format="float", example=0.85)
 * )
 */

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'status', 'importance', 'deadline'
    ];
}
