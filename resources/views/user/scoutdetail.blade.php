<x-app-layout>
  <!DOCTYPE html>
    <body>
        <div class="w-11/12 md:w-1/2 text-center text-2xl text-white bg-blue-300 border-white border-2 rounded-full mx-auto my-4">
            スカウトの詳細
        </div>
        <div class="container w-full md:w-3/5 mx-auto text-center border border-4 border-gray-300 rounded-xl bg-white px-1 md:px-4 py-3 mb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 justify-center space-y-2 md:space-y-0 md:space-x-2">
                <div id="bandInfomation" class="container border border-4 border-gray-300 rounded-xl w-full mx-auto px-1 pt-1 pb-2 space-y-1 text-left">
                    <div class="w-11/12 md:w-2/3 text-center text-xl text-white bg-blue-500 border-white border-2 rounded-full mx-auto">
                        バンドの情報
                    </div>
                    <div id="name" class="">
                        <p class="font-lg">募集者のバンド名</p>
                        <p class="text-xl">{{ $band->name }}</p>
                    </div>
                    <div id="member">
                        <p class="font-lg">メンバー</p>
                        <div id="memberTable" class="flex flex-col">
                            <div class="-m-1.5 overflow-x-auto">
                                <div class="p-1.5 min-w-full inline-block align-middle">
                                    <div class="border border-2 border-gray-300 rounded-lg overflow-hidden">
                                        <table class="min-w-full divide-y divide-gray-400">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="px-3 py-1 text-left text-sm text-gray-500 uppercase">名前</th>
                                                    <th scope="col" class="px-3 py-1 text-left text-sm text-gray-500 uppercase">学年</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @foreach($band->user_profiles as $member)
                                                    <tr>
                                                        <td class="px-3 py-1 whitespace-nowrap text-md">{{ $member->name }}</td>
                                                        <td class="px-3 py-1 whitespace-nowrap text-md">{{ $member->grade }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="introduction" class="mb-1">
                        <p class="font-lg">バンド紹介文</p>
                        <p class="px-0.5 border-2 border-gray-300 rounded-lg whitespace-pre-line">{{ $band->introduction }}</p>
                    </div>
                </div>
          
            <div id="scoutInfo" class="container border border-4 border-gray-300 rounded-xl w-full mx-auto px-1 pt-1 pb-2 space-y-1 text-left">
                <div class="w-11/12 md:w-2/3 text-center text-xl text-white bg-blue-500 border-white border-2 rounded-full mx-auto">
                    スカウトの情報
                </div>
                <p>タイトル</p>
                <p class="text-xl">{{ $scout->title }}</p>
                <p>依頼楽器：{{ $scout->instrument->name_jp }}</p>
                <p>メッセージ</p>
                <p>{{ $scout->message }}</p>
            </div>
        </div>
      
            <div id="approve" class="mt-2">
                <form action="{{ route('scout_approve', ['user'=> $user->id, 'scout'=> $scout->id]) }}" method="POST">
                @csrf
                @method('PUT')
                    <input type="submit" value="スカウトを承認する">
                </form>
            </div>
    </body>
</html>

</x-app-layout>