<x-app-layout>
  <!DOCTYPE html>
    <body>
      <div class="w-11/12 md:w-1/2 text-center text-2xl text-white bg-blue-300 border-white border-2 rounded-full mx-auto my-4">
        詳細情報
      </div>
      <div class="container w-full md:w-1/2 mx-auto text-center border border-4 border-gray-300 rounded-xl bg-white px-1 md:px-4 py-3 mb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 justify-center space-y-2 md:space-y-0 md:space-x-2">
          <div id="userprofile" class="row-span-2 container border border-4 border-gray-300 rounded-xl w-full mx-auto px-1 pt-1 pb-2 space-y-1 text-left">
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
          
          <div id="createScout" class="row-span-2 container border border-4 border-gray-300 rounded-xl w-full mx-auto px-1 pt-1 pb-2 space-y-1 text-left">
            <div class="w-11/12 md:w-2/3 text-center text-xl text-white bg-blue-500 border-white border-2 rounded-full mx-auto">
              スカウトの作成
            </div>
            <form action="{{ route('scout_store', ['band'=> $band->id, 'user'=> $user->id]) }}" method="POST">
            @csrf
              <div id="title" class="mb-1"> 
                <p>スカウトのタイトル</p>
                <input class="w-full" type="text" name="scout[title]" value="{{ old('scout.title') }}">
                <p class="error_name" style="color:red">{{ $errors->first('scout.title') }}</p>
              </div>
              <div id="instruments" class="mb-1">
                <p>依頼楽器</p>
                @foreach($user->instruments as $inst)
                 <input type="radio" name="scout[instrument_id]" value="{{ $inst->id }}">{{ $inst->name }}</input>
                @endforeach
              </div>
              <div id="message" class="mb-1">
                <p>スカウトメッセージ</p>
                <p class="text-sm text-gray-500">スカウトの理由などを記入しましょう</p>
                <textarea class="w-full h-5/6" type="text" name="scout[message]" value="{{ old('scout.message') }}"></textarea>
                <p class="error_name" style="color:red">{{ $errors->first('scout.message') }}</p>
              </div>
              <div id="userid">
                <input type="hidden" name="userid" value="{{ $user->id }}">
                <input type="hidden" name="bandid" value="{{ $band->id }}">
                <p class="error_name" style="color:red">{{ $errors->first('userid') }}</p>
              </div>
              <input type="submit" value="作成する">
            </form>
          </div>
        </div>
      </div>
    </body>
</x-app-layout>