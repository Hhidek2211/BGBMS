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
      <a href="/band/{{ $band->id }}}/edit" class="bandedit">バンドプロフィール編集</p>
      <a href="/band/{{ $band->id }}/recruitment/create" class="recruitmentcreate">メンバー募集作成</a>
      <a href="/band/{{ $band->id }}/applist" class="applist">募集への応募一覧</a>
    </body>
</html>

</x-app-layout>