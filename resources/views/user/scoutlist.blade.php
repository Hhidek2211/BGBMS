<x-app-layout>
  <!DOCTYPE html>
    <body>
        <div class="w-11/12 md:w-1/2 text-center text-2xl text-white bg-blue-300 border-white border-2 rounded-full mx-auto my-4">
            あなたへのスカウト一覧
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 justify-around w-10/12 md:w-3/5 mx-auto">
            @foreach( $scouts as $scout )
                <a class="container border border-4 border-gray-300 rounded-xl bg-white w-full h-56 mx-auto px-2 py-2" href="{{ route('scout_detail', ['user'=> $user->id, 'scout'=> $scout->id ]) }}">
                    <div class="text-center display:inline-block ">
                        <p class="text-xl">{{ $scout->band_profile->name }}
                        <span class="text-sm">さん</span></p>
                    </div>
                    <p>タイトル：</p>
                    <p>{{ $scout->title }}</p>
                    <p>依頼楽器：{{ $scout->instrument->name_abb }}</p>
                    <p>メッセージ：</p>
                    <p>{{ $scout->message }}</p>
                </a>
            @endforeach
        </div>
    </body>
</html>

</x-app-layout>