<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CustomizationAssetController extends Controller
{
    public function uploadLogo(Request $request): JsonResponse
    {
        $data = $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:png,jpg,jpeg,webp',
                'max:3072',
            ],
        ]);

        $file = $data['file'];

        $user = $request->user();
        $extension = strtolower($file->getClientOriginalExtension() ?: 'png');

        $directory = 'customization/logos/' . $user->id;
        $filename = Str::uuid()->toString() . '.' . $extension;

        $storedPath = $file->storeAs($directory, $filename, 'public');

        return response()->json([
            'message' => 'Logo uploadé avec succès.',
            'data' => [
                'path' => $storedPath,
                'url' => Storage::disk('public')->url($storedPath),
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ],
        ], 201);
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $data = $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:png,jpg,jpeg,webp',
                'max:5120',
            ],
        ]);

        $file = $data['file'];

        $user = $request->user();
        $extension = strtolower($file->getClientOriginalExtension() ?: 'png');

        $directory = 'customization/images/' . $user->id;
        $filename = Str::uuid()->toString() . '.' . $extension;

        $storedPath = $file->storeAs($directory, $filename, 'public');

        return response()->json([
            'message' => 'Image uploadée avec succès.',
            'data' => [
                'path' => $storedPath,
                'url' => Storage::disk('public')->url($storedPath),
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ],
        ], 201);
    }
}