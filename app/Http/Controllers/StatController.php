<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index(): JsonResponse
    {
        $stats = Stat::orderBy('order')->get();
        return response()->json($stats);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'label' => 'required|string',
            'value' => 'required|string',
            'order' => 'integer',
            'active' => 'boolean',
        ]);

        $stat = Stat::create($data);
        return response()->json($stat, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $stat = Stat::findOrFail($id);

        $data = $request->validate([
            'label' => 'string',
            'value' => 'string',
            'order' => 'integer',
            'active' => 'boolean',
        ]);

        $stat->update($data);
        return response()->json($stat);
    }

    public function destroy(int $id): JsonResponse
    {
        Stat::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
