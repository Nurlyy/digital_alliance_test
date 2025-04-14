<?php

namespace App\Swagger;
use OpenApi\Annotations as OA;

class Schemas
{
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

/**
 * @OA\Schema(
 *     schema="TaskCreateRequest",
 *     required={"title", "status", "importance", "deadline"},
 *     @OA\Property(property="title", type="string", example="Подготовить презентацию"),
 *     @OA\Property(property="description", type="string", example="Подготовить презентацию для заказчика"),
 *     @OA\Property(property="status", type="string", enum={"TODO", "IN_PROGRESS", "COMPLETED"}),
 *     @OA\Property(property="importance", type="integer", example=4),
 *     @OA\Property(property="deadline", type="string", format="date-time", example="2024-12-01T12:00:00")
 * )
 */

/**
 * @OA\Schema(
 *     schema="TaskUpdateRequest",
 *     @OA\Property(property="title", type="string", example="Обновленное название"),
 *     @OA\Property(property="description", type="string", example="Обновленное описание"),
 *     @OA\Property(property="status", type="string", enum={"TODO", "IN_PROGRESS", "COMPLETED"}),
 *     @OA\Property(property="importance", type="integer", example=3),
 *     @OA\Property(property="deadline", type="string", format="date-time", example="2024-12-10T15:30:00")
 * )
 */
    

/**
 * @OA\Schema(
 *     schema="TaskListResponse",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Task")
 *     )
 * )
 */

/**
 * @OA\Schema(
 *     schema="TaskSingleResponse",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         ref="#/components/schemas/Task"
 *     )
 * )
 */
 }