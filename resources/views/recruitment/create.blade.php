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
        募集の作成 - {{ $band->name }}
      </div>
      <div class="container w-11/12 md:w-3/5 mx-auto text-center border border-4 border-gray-300 rounded-xl bg-white px-3 md:px-6 py-3 mb-12">
        <form action="{{ route('recruitmentstore', ['band'=> $band->id]) }}" method="POST">
        @csrf
          <div id="title" class="mb-4 text-left">
           <h2 class="text-lg">募集タイトル</h2>
           <p class="text-sm text-gray-500">どんなイベントに参加するか、どんなテーマのバンドなのか等書いてください（30文字以内）</p>
           <input class="w-full" type="text" name="createrecruit[title]" value="{{ old('createrecruit.title') }}">
          </div>
          
          <div class="flex flex-wrap md:flex-nowrap text-left">
            <div id="instrument" class="w-full md:w-1/3">
              <h2 class="text-lg">募集楽器</h2>
              <p class="text-sm text-gray-500">募集したい楽器を選択</p>
              <div class="grid grid-cols-2 gap-x-2">
                @foreach ($instruments as $instrument)
                      <label>
                      <input type="checkbox"  value="{{ $instrument->id }}" name="recruitinst[]">
                          {{ $instrument->name_jp }}
                      </input>
                      </label>
                @endforeach
              </div>
            </div>
            
            <div id="introduction" class="w-full md:w-3/5">
              <h2 class="text-lg">募集メッセージ</h2>
              <p class="text-sm text-gray-500">募集したいメンバーの条件など自由に入力</p>
              <textarea class="w-full h-5/6" type="text" name="createrecruit[message]" value="{{ old('createrecruit.message') }}"></textarea>
            </div>
          </div>
          
          <input class="mt-12 mb-3" type="submit" value="募集開始！">
        </form>
      </div>
    </body>
</html>

</x-app-layout>