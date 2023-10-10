<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    
    <body>
        <div class="w-11/12 md:w-1/2 text-center text-2xl text-white bg-blue-300 border-white border-2 rounded-full mx-auto my-4">
            応募の詳細
        </div>
        
        <div class="flex flex-wrap space-y-4 md:space-y-0 md:space-x-2 justify-around container w-full md:w-3/5 mx-auto text-center border border-4 border-gray-300 rounded-xl bg-white px-1 md:px-4 py-3 mb-12">
            <div id="appedUserInfo" class="container w-full md:w-5/12 border border-4 border-gray-300 text-left rounded-xl px-0.5">
                <div class="w-11/12 md:w-2/3 text-center text-xl text-white bg-blue-500 border-white border-2 rounded-full mx-auto">
                    ユーザー情報
                </div>
                <div id="name&grade" class="mb-2">
                    <p class="text-base">名前</p>
                    <p class="text-lg">{{ $user->name }}</p>
                    <p class="text-base">学年</p>
                    <p class="text-lg">{{ $user->grade }}回生</p>
                </div>
                <div class="mb-2">
                    <p>担当可能楽器</p>
                    <p class="text-lg">
                        @foreach ($user->instruments as $userinst)
                            {{ $userinst->name_abb }} 
                        @endforeach
                    </p>
                </div>
                <p>自己紹介</p>
                <div class="whitespace-pre-line border border-2 border-gray-300 rounded-xl mb-1">{{ $user->introduction }}</div>
            </div>
            <div id="appInfo" class="container w-full md:w-5/12 border border-4 border-gray-300 text-left rounded-xl px-0.5">
                <div class="w-11/12 md:w-2/3 text-center text-xl text-white bg-blue-500 border-white border-2 rounded-full mx-auto">
                    応募の情報
                </div>
                <div class="mb-2">
                    <p class="text-base">応募楽器</p>
                    <p class="text-lg">{{ $appinfo->instrument->name_jp }}</p>
                </div>
                <p>応募メッセージ</p>
                <p class="whitespace-pre-line border border-2 border-gray-300 rounded-xl mb-3">{{ $appinfo->message }}</p>
                <div id="approval" class="text-center text-lg">
                    <form action="{{ route('app_approval', ['band'=> $band->id, 'user'=> $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                        <input type="submit" value="応募を承認する">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

</x-app-layout>