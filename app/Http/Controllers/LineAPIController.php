<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use App\Models\Lineapi;

class LineAPIController extends Controller
{
    //リクエストの種類を判別し、処理を分岐させる    注意点：現状一つのリクエストに含まれるメッセージを１つしか想定していないので全く持って不完全。複数メッセージに対応する方法を考えるべし。
    public function processingBranch(Request $request, Lineapi $lineapi) {
        $httpClient = new CurlHTTPClient(config('services.line.channel_token'));   //設定らしい
        $bot = new LINEBot($httpClient, ['channelSecret' => config('services.line.messenger_secret')]);
        $inputs = $request-> all();
    
        if (empty($inputs['events'])) {     //リクエストのイベントタイプ判別
            $requestTypes = 'hoge';        //検証リクエスト等の処理のため何かを代入してswitch文の例外処理にかける
    }   else {
            if (array_key_exists('message', $inputs['events'][0])) {
                $requestTypes = $inputs['events'][0]['message']['type']; //一度のリクエストに含まれるイベントは複数含まれる前提
          } elseif (array_key_exists('link', $inputs['events'][0])) {
                $requestTypes = 'certification';
          } else {
                $requestTypes = 'hoge';    
            }
            $replyToken = $inputs['events'][0]['replyToken'];
            $lineUserId = $inputs['events'][0]['source']['userId'];
        } 
        
        //アカウント認証後の処理（認証成功のメッセージ）
        if ($requestTypes == 'certification') {
            if ($inputs['events'][0]['link']['result'] == "ok") {
                $replyMessage = '認証に成功しました！';
                $this->saveAccount($inputs, $lineUserId);
        }}
        
        //アカウント認証以外の処理
        switch ($requestTypes) {    //送られてきたJsonが含むイベント属性によって処理を分岐、返信したいものでなければステータス200を返す
            case 'text' :   //分岐は２パターン　１. 「連携」と入力して連携リンクを送信　３. 何でもないときの適当な返信
                $textContent = $inputs['events'][0]['message']['text'];
                if($textContent == "連携") {
                    $this-> coopAccountStart($replyToken, $lineUserId, $bot, $httpClient);
              } else {
                    $replyMessage = '機能はまだまだ増えるよ！…たぶんだけど';
                }
                break;
            case 'follow' : //登録時にアカウント連携するよう促す
                $replyMessage ="ご登録ありがとうございます！\nまずはBGBMSでお使いのメアドを登録してください！\nチャットに「連携」と入力をお願いします！";
                break;
            default :   //上記以外に対してはとりあえず値を返す
                break;
        }        
        $reply= $bot-> replyText($replyToken, $replyMessage);
    }
    
    //連携プロセス開始　連携済みかチェックし、まだならばリンクを送る処理へ移動
    public function coopAccountStart($replyToken, $lineUserId, $bot, $httpClient) {
        $checkCoopedAcount = Lineapi::where('line_userid', $lineUserId)->first();   //すでにユーザー連携済みか確認
        
        if(is_null($checkCoopedAcount)) {
            $this-> accountLink($lineUserId, $replyToken, $bot, $httpClient);
      } else {
            $replyMessage = 'すでに連携済みです！';
            $reply = $bot-> replyText($replyToken, $replyMessage);
        }
    }
    
    //アカウント連携用リンクを送信、以降LineLogincontrollerにて処理
    public function accountLink($lineUserId, $replyToken, $bot, $httpClient) {
        $response = $httpClient->post("https://api.line.me/v2/bot/user/{$lineUserId}/linkToken",[]);
        $rowBody = $response->getRawBody();
        $responseObject = json_decode($rowBody);
        $linkToken = object_get($responseObject, "linkToken");
        
        $replyMessage = new TemplateMessageBuilder("アカウント連携", new ButtonTemplateBuilder("アカウント連携します。", "OKをクリックしてBGBMSにログイン", null, [
                        new UriTemplateActionBuilder("OK", route("line_login",["linkToken" => $linkToken]))
                        ]));
        $reply = $bot-> replyMessage($replyToken, $replyMessage);
    }
    
    //連携後処理　認証してきたラインユーザーデータを保存
    public function saveAccount($inputs, $lineUserId) {
        $nonce = $inputs['events'][0]['link']['nonce'];
        $saveLineUser = Lineapi::where('nonce', $nonce)->first();
        if(is_null($saveLineUser)){
            return;
        }
        $saveLineUser->update([
            "line_userid" => $lineUserId
        ]);
    }
    
    //プッシュメッセージの送信
    public function sendPushMessage($userid, $pushMessage) {
        $lineUser = Lineapi::where('user_id', $userid)-> first();
        $httpClient = new CurlHTTPClient(config('services.line.channel_token'));   //設定らしい
        $bot = new LINEBot($httpClient, ['channelSecret' => config('services.line.messenger_secret')]);
        
        //dd($lineUser);
        if(!is_null($lineUser)) {
        $textMessageBuilder = new TextMessageBuilder($pushMessage);
        $push = $bot-> pushMessage($lineUser->line_userid, $textMessageBuilder);
        }
        return redirect()-> route('top');   //ここにリダイレクト処理を書かざるを得なくなったのだけ残念
    }
}