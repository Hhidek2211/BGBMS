<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

        <title>Laravel</title>
    </head>
    
    <body>
       とりあえず飛んでるかこれでわかるな！<br><br>
       <a href="/user/create">ユーザー情報編集</a>
       <a href="/band/create">バンド作成</a>
    </body>
</html>

</x-app-layout>