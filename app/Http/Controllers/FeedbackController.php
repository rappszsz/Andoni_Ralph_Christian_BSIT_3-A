<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FeedbackController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $response = Http::post('https://hook.us2.make.com/7p21km41yi7qxuv26qrc5ild3y9q4rct', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message']
        ]);

        return response()->json([
            'message' => $response->successful()
            ? 'Thank you for your feedback!'
            : 'Failed to submit feedback',
            'success' => $response->successful()
        ], $response -> status());
    }
}
