<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

        <title>BGBMS</title>
    </head>
    
    <body>
        <div class="w-11/12 md:w-1/2 text-center text-2xl text-white bg-blue-300 border-white border-2 rounded-full mx-auto my-4">
            マイメニュー
        </div>
        <div class="flex flex-wrap md:flex-nowrap justify-around text-center mx-auto my-4 w-3/5 md:w-3/5 space-y-2 md:space-y-0 md:space-x-3">
            <div class="w-full md:w-1/3 h-60 container border border-gray-300 border-4 bg-white rounded-xl">
                <a class="text-xl my-1" href="{{ route('band_list', ['user'=> $user->id]) }}">あなたのバンド</a>
                <div class="flex flex-wrap my-2">
                    @foreach($bands as $band)
                    <p class="w-2/4 h-1/5">{{ $band->name }}</p>
                    @endforeach
                </div>
            </div>
            <div class="w-full md:w-1/3 h-60 container border border-gray-300 border-4 bg-white rounded-xl">
                <a class="text-xl my-1" href="{{ route('scout_list', ['user'=> $user->id]) }}">あなたへのスカウト一覧</a>
                <div class="flex flex-wrap my-2">
                    @foreach($scouts as $scout)
                    <p class="w-2/4 h-1/5">{{ $scout->band_profile->name }}</p>
                    @endforeach
                </div>
            </div>
            <div class="w-full md:w-1/3 h-60 container border border-gray-300 border-4 bg-white rounded-xl">
                <a class="text-xl my-1" href="{{ route('recruitment_list') }}">現在の募集</a>
                <div class="flex flex-wrap my-2">
                    @foreach($recruitments as $recruitment)
                    <p class="w-full h-1/5">{{ $recruitment->title }}</p>
                    @endforeach
                </div>
            </div>
        </div>
        
            <a class="block w-11/12 md:w-1/2 text-center text-xl border border-gray-300 border-4 bg-white mx-auto my-2" href="{{ route('band_create') }}">バンド作成</a>
            <a class="block w-11/12 md:w-1/2 text-center text-xl border border-gray-300 border-4 bg-white mx-auto my-2" href="{{ route('user_edit', ['user'=> $user->id]) }}">プロフィール編集</a>
        {{-- <div class="container mx-auto my-4 border-2 border-gray-400 bg-white rounded-lg"> --}}
            
        </div>
    </body>
</html>

</x-app-layout>