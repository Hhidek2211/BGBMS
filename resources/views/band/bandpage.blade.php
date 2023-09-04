<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

        <title>Laravel</title>
    </head>
    
    <body>
      <h2>{{ $band->name }} のバンドメニュー</h2>
      <a href="{{ route('bandedit', ['band'=> $band->id]) }}" class="bandedit">バンドプロフィール編集</a><br>
      <a href="{{ route('recruitmentcreate', ['band'=> $band->id ]) }}" class="recruitmentcreate">メンバー募集作成</a><br>
      <a href="{{ route('applist', ['band'=> $band->id]) }}" class="applist">募集への応募一覧</a><br>
      <a href="{{ route('scout_userselect', ['band'=> $band->id] )}}" class="scoutcreate">スカウトの作成</a>
    </body>
</html>

</x-app-layout>