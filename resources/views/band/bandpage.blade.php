<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

        <title>Laravel</title>
    </head>
    
    <body>
      <h2 class="w-1/2 text-center text-2xl text-white bg-blue-300 border-white border-2 rounded-full mx-auto my-4">{{ $band->name }}</h2>
      <div class="container w-full md:w-3/5 mx-auto text-center border border-4 border-gray-300 rounded-xl bg-white px-3 py-3 pb-5">
        <p class="text-3xl mb-10">バンドメニュー</p>
        <div class="grid gap-y-2">
          <a class="block w-4/5 h-10 mx-auto px-3 border border-3 border-gray-400 bg-white rounded-full text-2xl" href="{{ route('bandedit', ['band'=> $band->id]) }}" class="bandedit">バンドプロフィール編集</a>
          <a class="block w-4/5 h-10 mx-auto px-3 border border-3 border-gray-400 bg-white rounded-full text-2xl" href="{{ route('recruitmentcreate', ['band'=> $band->id ]) }}" class="recruitmentcreate">メンバー募集作成</a>
          @if ($showApplistFlag == true)
            <a class="block w-4/5 h-10 mx-auto px-3 border border-3 border-gray-400 bg-white rounded-full text-2xl" href="{{ route('applist', ['band'=> $band->id]) }}" class="applist">募集への応募一覧</a>
          @endif
          <a class="block w-4/5 h-10 mx-auto px-3 border border-3 border-gray-400 bg-white rounded-full text-2xl" href="{{ route('scout_userselect', ['band'=> $band->id] )}}" class="scoutcreate">スカウトの作成</a>
        </div>
      </div>
    </body>
</html>

</x-app-layout>