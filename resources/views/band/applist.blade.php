<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    
    <body>
        <div id="userband">
            <div class="w-11/12 md:w-1/2 text-center text-2xl text-white bg-blue-300 border-white border-2 rounded-full mx-auto my-4">
                募集への応募一覧
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 justify-around w-10/12 md:w-3/5 mx-auto">
            @foreach($appinfos as $appinfo)
                <a class="container border border-4 border-gray-300 rounded-xl bg-white w-full h-56 mx-auto px-2 py-2" href="{{ route('appdetail', ['band'=> $band->id, 'user'=> $appinfo->user_profile->id]) }}">
                    <div class="text-center display:inline-block ">
                        <p class="text-xl">{{ $appinfo->user_profile->name }}
                        <span class="text-sm">さん</span></p>
                    </div>
                    <p>応募楽器：{{ $appinfo->instrument->name_abb }}</p>
                    <p>メッセージ：</p>
                    <p>{{ $appinfo->message }}</p>
                </a>
            @endforeach
            </div>
    </body>
</html>

</x-app-layout>


