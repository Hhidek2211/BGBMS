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
         <h1>{{ $band->name }}さんの募集に対する応募</h1>
         @foreach($appinfos as $appinfo)
            <a href="/band/{{ $band->id }}/app/{{ $appinfo->user_profile->id }}/detail">{{ $appinfo->user_profile->name }}さん</a>
            <p>応募楽器：{{ $appinfo->instrument->name }}</p>
            <p>メッセージ：</p>
            <p>{{ $appinfo->message }}</p>
         @endforeach
        </div>
    </body>
</html>

</x-app-layout>
