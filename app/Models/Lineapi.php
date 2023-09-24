<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lineapi extends Model
{
    use HasFactory;
    
    public function replyText() {
        
    }
    
    protected $fillable = [
        'line_userid',
        'nonce',
        'user_id'
        ];
    
    public function enableRegisterateMode ($LineUserId) {
        $usersRegistering = session('userRegistering');
        if(in_array($LineUserId, $usersRegistering)) {
        } else {
            session()-> push('userRegistering', $LineUserId);
        }
        return $replyMessage = "メールアドレスを登録します！\nBGBMSで登録しているメールアドレスを入力してください。";
    }
}
