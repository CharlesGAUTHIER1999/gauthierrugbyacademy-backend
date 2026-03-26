<?php

namespace App\Services\AI;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class OpenAIImageService
{
    /**
     * @throws ConnectionException
     */
    public function generateImage(string $prompt, string $filenamePrefix = 'design'): array
    {
        $response = Http::withToken(config('services.openai.key'))
            ->timeout(120)
            ->post('https://api.openai.com/v1/images/generations', [
                'model' => config('services.openai.image_model', 'gpt-image-1'),
                'prompt' => $prompt,
                'size' => '1024x1024',
            ]);

        if ($response->failed()) {
            throw new RuntimeException('OpenAI image generation failed: '.$response->body());
        }

        $payload = $response->json();

        $base64 = $payload['data'][0]['b64_json'] ?? null;

        if (! $base64) {
            throw new RuntimeException('No image returned by OpenAI.');
        }

        $binary = base64_decode($base64);
        $path = 'designs/'.uniqid($filenamePrefix.'_').'.png';

        Storage::disk('public')->put($path, $binary);

        return [
            'path' => $path,
            'url' => Storage::disk('public')->url($path),
            'payload' => $payload,
        ];
    }
}