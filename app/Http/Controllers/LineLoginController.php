<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Models\Lineapi;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LineLoginController extends Controller
{
    use AuthenticatesUsers;
    
    //ログインフォームの起動
    public function showLoginForm(Request $request) {
        if(\Auth::check()){     //ログイン状態だった場合強制ログアウトする
            \Auth::logout();
        }
        $linkToken = $request->get("linkToken");
        return view("auth.login", ["linkToken" => $linkToken]);    
    }
    
    //ログイン処理
    public function login(Request $request) {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            return $this->externalLine($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    
    //ログイン情報をラインへ送信、必要なnonceを生成して保存
    public function externalLine(Request $request) {
        $linkToken = $request->get("linkToken");
        $nonce = \Hash::make(random_bytes(32));     //nonceの作成
        $email = $request->get("email");
        $user = User::query()->where("email", $email)->first();
        $Lineapi = Lineapi::query()-> where('user_id', $user->id)->first();     //Lineapiにデータ保
        if (is_null($Lineapi)) {
            $Lineapi = new Lineapi;   
        }
        $Lineapi->user_id = $user->id;
        $Lineapi->nonce = $nonce;
        $Lineapi->save();
        
        return Redirect("https://access.line.me/dialog/bot/accountLink?linkToken={$linkToken}&nonce={$nonce}");
        
    }
}
