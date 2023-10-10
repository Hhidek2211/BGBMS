<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

        <title>Laravel</title>
    </head>
    
    <body>
      <div class="w-11/12 md:w-1/2 text-center text-2xl text-white bg-blue-300 border-white border-2 rounded-full mx-auto my-4">
        募集の詳細
      </div>
      
      <div class="container w-full md:w-3/5 mx-auto text-center border border-4 border-gray-300 rounded-xl bg-white px-1 md:px-4 py-3 mb-12">
        <div id="title" class="text-xl md:text-2xl mb-3">
            {{ $recruit->title }}
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 justify-center space-y-2 md:space-y-0 md:space-x-2">
          <div id="bandInfomation" class="row-span-2 container border border-4 border-gray-300 rounded-xl w-full mx-auto px-1 pt-1 pb-2 space-y-1 text-left">
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
            
          <div id="recruitmentInfomation" class="container border border-4 border-gray-300 rounded-xl w-full mx-auto px-1 pt-1 pb-2 space-y-1 text-left">
            <div class="w-11/12 md:w-2/3 text-center text-xl text-white bg-blue-500 border-white border-2 rounded-full mx-auto">
              募集の情報
            </div>
            <div id="instruments">
              <p class="font-lg">募集楽器</p>
              <p class="text-xl">
                @foreach($insts as $inst)
                  {{ $inst->name_abb }}
                @endforeach
              </p>
            </div>
            <div class="message">
                <p class="font-lg">募集メッセージ</p>
                <p class="px-0.5 border-2 border-gray-300 rounded-lg whitespace-pre-line">{{ $recruit->message }}</p>
            </div>
          </div>
          
          <div id="appForm" class="container border border-4 border-gray-300 rounded-xl w-full mx-auto px-1 pt-1 pb-2 space-y-1 text-left">
            <div class="w-11/12 md:w-2/3 text-center text-xl text-white bg-blue-500 border-white border-2 rounded-full mx-auto">
              応募フォーム
            </div>
            <form action="{{ route('application', ['recruit'=> $recruit->id ]) }}" method="POST">
              @csrf  
              <div id="appinsts">
                <p class="font-lg">応募する楽器</p>
                @foreach($matchInsts as $matchInst)
                    <input type="radio" name="application[appinstid]" value="{{ $matchInst->id }}">{{ $matchInst->name_jp }}</input>
                @endforeach
              </div>
              <div id="message">
                  <p class="font-lg">メッセージ入力欄</p>
                  <p class="text-sm text-gray-500">応募に際しての備考などを書きましょう</p>
                  <textarea class="w-full h-32" name="application[message]"></textarea>
              </div>
              <div id="userid">
                  <input type="hidden" name="application[user_profile_id]" value="{{ $user->id }}">
              </div>
              <div class="text-xl text-center" >
                <input type="submit" value="送信する">
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </body>
</html>

</x-app-layout>