<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateDesignRequest;
use App\Models\Design;
use App\Models\PromptHistory;
use App\Services\AI\OpenAIImageService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;

class AIDesignController extends Controller
{
    /**
     * @throws ConnectionException
     */
    public function __invoke(
        GenerateDesignRequest $request,
        OpenAIImageService $openAIImageService
    ): JsonResponse {
        $result = $openAIImageService->generateImage(
            $request->validated('prompt'),
            'fitness_design'
        );

        $design = Design::create([
            'user_id' => $request->user()->id,
            'product_id' => $request->validated('product_id'),
            'product_option_id' => $request->validated('product_option_id'),
            'name' => $request->validated('name') ?? 'Generated design',
            'prompt' => $request->validated('prompt'),
            'status' => 'generated',
            'image_path' => $result['path'],
            'preview_url' => $result['url'],
            'provider' => 'openai',
            'metadata' => $result['payload'],
        ]);

        PromptHistory::create([
            'user_id' => $request->user()->id,
            'design_id' => $design->id,
            'prompt' => $request->validated('prompt'),
            'provider' => 'openai',
            'status' => 'success',
            'response_payload' => $result['payload'],
        ]);

        return response()->json([
            'message' => 'Design generated successfully.',
            'data' => $design,
        ], 201);
    }
}