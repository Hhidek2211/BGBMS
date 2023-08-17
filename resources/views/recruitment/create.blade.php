<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

        <title>Laravel</title>
    </head>
    
    <body>
      <h1>募集作成</h1>
      <form action="/band/{{ $band->id }}/recruitment/createrecruit" method="POST">
        @csrf
        <div class="title">
         <h2>募集タイトル</h2>
         <input type="text" name="createrecruit[title]" value="{{ old('createrecruit.title') }}">
        </div>
        <div class="instrument">
          <h2>募集楽器</h2>
          @foreach ($instruments as $instrument)
                <label>
                <input type="checkbox"  value="{{ $instrument->id }}" name="recruitinst[]">
                    {{ $instrument->name }}
                </input>
                </label>
          @endforeach
        </div>
        <div class="introduction">
          <h2>紹介文</h2>
          <textarea type="text" name="createrecruit[message]" value="{{ old('createrecruit.message') }}"></textarea>
        </div>
        <input type="submit" value="募集開始！">
      </form>
    </body>
</html>

</x-app-layout>