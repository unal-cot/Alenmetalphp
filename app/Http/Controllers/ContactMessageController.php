<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(): JsonResponse
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        return response()->json($messages);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'message' => 'required|string',
        ]);

        $message = ContactMessage::create($data);
        return response()->json($message, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $message = ContactMessage::findOrFail($id);
        $data = $request->validate(['read' => 'boolean']);
        $message->update($data);
        return response()->json($message);
    }

    public function destroy(int $id): JsonResponse
    {
        ContactMessage::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
