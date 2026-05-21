<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(): JsonResponse
    {
        $services = Service::orderBy('order')->get();
        return response()->json($services);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'icon' => 'required|string',
            'image_url' => 'nullable|string',
            'features' => 'nullable|string',
            'order' => 'integer',
            'active' => 'boolean',
        ]);

        $service = Service::create($data);
        return response()->json($service, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $service = Service::findOrFail($id);

        $data = $request->validate([
            'title' => 'string',
            'description' => 'nullable|string',
            'icon' => 'string',
            'image_url' => 'nullable|string',
            'features' => 'nullable|string',
            'order' => 'integer',
            'active' => 'boolean',
        ]);

        $service->update($data);
        return response()->json($service);
    }

    public function destroy(int $id): JsonResponse
    {
        Service::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
