<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div id="title" class="my-20 text-center">
            <div class="text-7xl text-white w-fit px-8 py-3 mx-auto rounded-full bg-blue-400">BGBMS</div>
            <div class="text-xl text-blue-400">BlueGrass Band Matching Service</div>
        </div>
        <div id="login" class="mx-auto w-11/12 md:w-1/2 flex flex-wrap justify-around space-y-2 md:space-y-0 text-center">
            <a class="w-full h-12 md:w-2/5 py-2 rounded-full text-white text-xl bg-green-400 font-bold" href="{{ route('login') }}">ログイン</a>
            <a class="w-full h-12 md:w-2/5 py-2 rounded-full text-white text-xl bg-orange-400 font-bold" href="{{ route('register') }}">新規登録</a>
        </div>
    </body>
</html>