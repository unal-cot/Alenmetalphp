<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index(): JsonResponse
    {
        $media = Media::orderBy('created_at', 'desc')->get();
        return response()->json($media);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate(['file' => 'required|file|max:10240']);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();

        $name = pathinfo($originalName, PATHINFO_FILENAME);
        $ext = $file->getClientOriginalExtension();
        $name = str_replace(
            ['ö', 'ü', 'ç', 'ş', 'ı', 'ğ', 'Ö', 'Ü', 'Ç', 'Ş', 'İ', 'Ğ'],
            ['o', 'u', 'c', 's', 'i', 'g', 'O', 'U', 'C', 'S', 'I', 'G'],
            $name
        );
        $name = preg_replace('/[^a-zA-Z0-9_-]/', '-', $name);
        $filename = Str::slug($name) . '-' . time() . '.' . $ext;

        $file->storeAs('uploads', $filename, 'public');

        $media = Media::create([
            'filename' => $originalName,
            'url' => '/storage/uploads/' . $filename,
            'alt' => $originalName,
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
        ]);

        return response()->json($media, 201);
    }

    public function destroy(int $id): JsonResponse
    {
        $media = Media::findOrFail($id);
        $path = str_replace('/storage/', '', $media->url);
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
        $media->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
