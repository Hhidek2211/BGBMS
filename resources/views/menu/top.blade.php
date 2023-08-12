<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

        <title>Laravel</title>
    </head>
    
    <body>
       <a href="/user/create">ユーザー情報編集</a><br>
       <a href="/band/create">バンド作成</a><br>
       <a href="/band/list">あなたのバンド</a><br>
    </body>
</html>

</x-app-layout>