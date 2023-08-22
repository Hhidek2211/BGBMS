<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    
    <body>
        <div class="app_userinfo">
         <h1>応募の詳細情報</h1>
         <h2>名前：{{ $user->name }}　学年：{{ $user->grade }}回生</h2>
         <p>楽器：
            @foreach ($user->instruments as $userinst)
                {{ $userinst->name }} 
            @endforeach
         </p>
         <p>自己紹介：</p>
         <p>{{ $user->introduction }}</p>
         <br>
         <p>応募楽器：{{ $appinfo->instrument->name }}</p>
         <p>応募メッセージ：</p>
         <p>{{ $appinfo->message }}</p>
        </div>
         <br>
        <div class="approval">
         <form action="/band/{{ $band->id }}/app/{{ $user->id }}/approval" method="POST">
          @csrf
          @method('PUT')
          <input type="submit" value="応募を承認する">
         </form>
        </div>
    </body>
</html>

</x-app-layout>
