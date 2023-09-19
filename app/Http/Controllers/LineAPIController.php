<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LineAPIController extends Controller
{
    public function index(Request $request) {
    
    $httpClient = new CurlHTTPClient($_ENV['LINE_CHANNEL_ACCESS_TOKEN']);
    $bot = new LINEBot($httpClient, ['channelSecret' => $_ENV['LINE_CHANNEL_SECRET']]);
        
    $request->collect('events')->each(function ($event) use ($bot) {
        $bot->replyText($event['replyToken'], $event['message']['text']);
    });
    return 'ok!';
    }
    
}
