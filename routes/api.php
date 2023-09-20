<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LineAPIController;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* 成功例
 $httpClient = new CurlHTTPClient($_ENV['LINE_ACCESS_TOKEN']);
 $bot = new LINEBot($httpClient, ['channelSecret' => $_ENV['LINE_CHANNEL_SECRET']]);

 Route::post('/webhook', function (Request $request) use ($bot) {
     $request->collect('events')->each(function ($event) use ($bot) {
         $bot->replyText($event['replyToken'], $event['message']['text']);
     });
     return 'ok!';
 });
 
*/

Route::controller(LineAPIController::class)-> group(function(){
    Route::post('/line/webhook', 'index')-> name('test');
}); 
