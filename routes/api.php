<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LineAPIController;
use App\Http\Controllers\LineLoginController;
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
    Route::post('/line/webhook', 'processingBranch')-> name('line_branch');
    Route::get('/line/text', 'replyText')-> name('line_text');
    Route::get('/line/follow', 'replyFollow')-> name('line_follow');
    Route::get('/line/pushMessage/{userid}/{pushMessage}', 'sendPushMessage')-> name('line_pushMessage');   //どうしても変数が受け渡しできずルーティングに直接記入するハメになっている。これは直したい。
}); 

Route::controller(LineLoginController::class)-> group(function(){
    Route::get("/line/login", "showLoginForm")-> name('line_loginStart');
    Route::post('/line/login', 'login')-> name('line_login');
});
