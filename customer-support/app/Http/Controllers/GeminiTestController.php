<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\GeminiService;


class GeminiTestController extends Controller
{
    public function test(GeminiService $geminiService)
    {
        $query = 'Create A History Study Plan';
        $response = $geminiService->sendQuery($query);

        return response()->json($response);
    }
}
