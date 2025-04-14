<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;



class TaskController extends Controller
{

    /**
 * @OA\Get(
 *     path="/api/tasks",
 *     summary="Получить список задач",
 *     tags={"Tasks"},
 *     @OA\Parameter(
 *         name="status",
 *         in="query",
 *         description="Фильтр по статусу (TODO, IN_PROGRESS, COMPLETED)",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Список задач",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Task"))
 *         )
 *     )
 * )
 */
    public function index(Request $request)
    {
        $query = Task::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return TaskResource::collection($query->get());
    }

    /**
 * @OA\Post(
 *     path="/api/tasks",
 *     summary="Создать новую задачу",
 *     tags={"Tasks"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/TaskRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Задача успешно создана",
 *         @OA\JsonContent(ref="#/components/schemas/Task")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ошибка валидации"
 *     )
 * )
 */
    public function store(TaskRequest $request)
    {
        $task = Task::create($request->validated());
        return new TaskResource($task);
    }

    /**
 * @OA\Get(
 *     path="/api/tasks/{id}",
 *     summary="Получить задачу по ID",
 *     tags={"Tasks"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID задачи",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Информация о задаче",
 *         @OA\JsonContent(ref="#/components/schemas/Task")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Задача не найдена"
 *     )
 * )
 */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
 * @OA\Put(
 *     path="/api/tasks/{id}",
 *     summary="Обновить задачу",
 *     tags={"Tasks"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID задачи",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/TaskRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Задача успешно обновлена",
 *         @OA\JsonContent(ref="#/components/schemas/Task")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Задача не найдена"
 *     )
 * )
 */
    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return new TaskResource($task);
    }

    /**
 * @OA\Delete(
 *     path="/api/tasks/{id}",
 *     summary="Удалить задачу",
 *     tags={"Tasks"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID задачи",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Задача удалена"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Задача не найдена"
 *     )
 * )
 */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->noContent();
    }

    /**
 * @OA\Get(
 *     path="/api/tasks/priority",
 *     summary="Получить приоритизированный список задач",
 *     description="Сортирует задачи по важности и сроку дедлайна. Также указывает, просрочена ли задача.",
 *     tags={"Tasks"},
 *     @OA\Response(
 *         response=200,
 *         description="Приоритизированный список задач",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="data", type="array", @OA\Items(
 *                  allOf={
 *                       @OA\Schema(ref="#/components/schemas/Task"),
 *                       @OA\Schema(
 *                           @OA\Property(property="priority_score", type="number"),
 *                           @OA\Property(property="is_overdue", type="boolean")
 *                       )
 *                   }
 *               ))
 *         )
 *     )
 * )
 */
    public function priority()
    {
        $tasks = Task::all()->map(function ($task) {
            $task->daysUntilDeadline = now()->diffInDays($task->deadline, false);
            $task->priority_score = $task->daysUntilDeadline > 0
                ? $task->importance * (1 / $task->daysUntilDeadline)
                : 0;
            return $task;
        })->sortByDesc('priority_score')->values();

        return TaskResource::collection($tasks);
    }
}


