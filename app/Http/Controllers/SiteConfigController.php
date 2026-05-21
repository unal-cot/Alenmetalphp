<?php

namespace App\Http\Controllers;

use App\Models\SiteConfig;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiteConfigController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(SiteConfig::pluck('value', 'key')->toArray());
    }

    public function update(Request $request): JsonResponse
    {
        $data = $request->all();
        foreach ($data as $key => $value) {
            if (is_string($key)) {
                SiteConfig::updateOrCreate(['key' => $key], ['value' => $value ?? '']);
            }
        }
        return $this->index();
    }
}
