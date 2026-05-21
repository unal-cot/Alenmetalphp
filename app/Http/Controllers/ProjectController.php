<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(): JsonResponse
    {
        $projects = Project::with('images')->orderBy('created_at', 'desc')->get();
        return response()->json($projects);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
            'category' => 'required|string',
            'completed_at' => 'nullable|date',
            'active' => 'boolean',
            'images' => 'nullable|array',
            'images.*.url' => 'required|string',
            'images.*.order' => 'integer',
        ]);

        $images = $data['images'] ?? [];
        unset($data['images']);

        $project = Project::create($data);

        foreach ($images as $img) {
            $project->images()->create($img);
        }

        return response()->json($project->load('images'), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $project = Project::findOrFail($id);

        $data = $request->validate([
            'title' => 'string',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
            'category' => 'string',
            'completed_at' => 'nullable|date',
            'active' => 'boolean',
            'images' => 'nullable|array',
            'images.*.url' => 'required|string',
            'images.*.order' => 'integer',
        ]);

        $images = $data['images'] ?? [];
        unset($data['images']);

        $project->update($data);

        if (!empty($images)) {
            $project->images()->delete();
            foreach ($images as $img) {
                $project->images()->create($img);
            }
        }

        return response()->json($project->load('images'));
    }

    public function destroy(int $id): JsonResponse
    {
        Project::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
