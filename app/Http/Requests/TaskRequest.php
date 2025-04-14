<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @OA\Schema(
 *     schema="TaskRequest",
 *     required={"title", "status", "importance", "deadline"},
 *     @OA\Property(property="title", type="string", example="Подготовить презентацию"),
 *     @OA\Property(property="description", type="string", example="Подготовить презентацию для заказчика"),
 *     @OA\Property(property="status", type="string", enum={"TODO", "IN_PROGRESS", "COMPLETED"}),
 *     @OA\Property(property="importance", type="integer", example=4),
 *     @OA\Property(property="deadline", type="string", format="date-time", example="2024-12-01T12:00:00")
 * )
 */

class TaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:TODO,IN_PROGRESS,COMPLETED',
            'importance' => 'required|integer|min:1|max:5',
            'deadline' => 'required|date|after:now'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
