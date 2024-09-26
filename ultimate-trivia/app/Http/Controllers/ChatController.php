<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function handleChat(Request $request)
    {
        $validated = $request->validate([
            'prompt' => 'required|string',
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/completions', [
            'model' => 'gpt-3.5-turbo',
            'prompt' => $validated['prompt'],
            'max_tokens' => 150,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return response()->json(['res' => $data['choices'][0]['text'] ?? 'No response']);
        } else {
            $errorData = $response->json();
            $errorMessage = $errorData['error']['message'] ?? 'Unknown error';
            return response()->json(['res' => $errorMessage], $response->status());
        }
    }
}
