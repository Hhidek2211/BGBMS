<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    
    <body>
        <div class="userband">
         <h1>あなたのバンド</h1>
         @foreach($userbands as $band)
            <a class="bandname" href="{{ route('bandpage', ['band'=> $band->id]) }}">{{ $band->name }}</a><br>
         @endforeach
        </div>
    </body>
</html>

</x-app-layout>