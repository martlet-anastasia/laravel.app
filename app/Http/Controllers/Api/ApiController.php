<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(['test'], 200);
    }
}
