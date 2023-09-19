<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;

class LineAPIController extends Controller
{
    public function index(Request $request LINEBot $bot): JsonResponse {
    
    return response()->json('success');
    
    }
    
}
