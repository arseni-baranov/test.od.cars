<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function available(Request $request): JsonResponse
    {
        $user = $request->user();
        $start = $request->input('start_time');
        $end = $request->input('end_time');

        if (!$start || !$end) {
            return response()->json([
                'message' => 'start_time and end_time are required'
            ], 422);
        }

        // категории, доступные пользователю по должности
        $allowedCategories = $user->position
            ->comfortCategories()
            ->pluck('comfort_categories.id');

        $cars = Car::query()
            ->whereIn('comfort_category_id', $allowedCategories)

            // фильтрация по модели
            ->when($request->filled('model'), function ($q) use ($request) {
                $q->where('model', 'like', '%' . $request->model . '%');
            })

            // фильтрация по категории
            ->when($request->filled('category_id'), function ($q) use ($request) {
                $q->where('comfort_category_id', $request->category_id);
            })

            // исключение занятых машин
            ->whereDoesntHave('reservations', function ($q) use ($start, $end) {
                $q->where(function ($q2) use ($start, $end) {
                    $q2->whereBetween('start_time', [$start, $end])
                        ->orWhereBetween('end_time', [$start, $end])
                        ->orWhere(function ($q3) use ($start, $end) {
                            $q3->where('start_time', '<=', $start)
                                ->where('end_time', '>=', $end);
                        });
                });
            })
            ->with('driver', 'comfortCategory')
            ->get();

        return response()->json($cars);
    }
}
