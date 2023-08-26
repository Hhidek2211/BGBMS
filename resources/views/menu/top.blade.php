<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

        <title>Laravel</title>
    </head>
    
    <body>
       <a href="{{ route('usercreate') }}">ユーザー情報作成</a><br>
       <a href="{{ route('useredit', ['user'=> $user->id]) }}">ユーザー情報編集</a><br>
       <a href="{{ route('bandcreate') }}">バンド作成</a><br>
       <a href="{{ route('bandlist', ['user'=> $user->id]) }}">あなたのバンド</a><br>
       <a href="{{ route('recruitmentlist') }}">現在の募集一覧</a>
    </body>
</html>

</x-app-layout>