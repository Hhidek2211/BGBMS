<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

        <title>Laravel</title>
    </head>
    
    <body>
      <div class="title">
          <h1>{{ $recruit->title }}</h1>
      </div>
      <div class="name">
          <p>募集者：{{ $band->name }}</p>
      </div>
      <div class="instruments">
          <p>募集楽器：</p>
          @foreach($insts as $inst)
            <p>{{ $inst->name }}</p>
          @endforeach
      </div>
      <div class="message">
          <p>メッセージ：</p>
          <p>{{ $recruit->message }}</p>
      </div>
      <br>
      <div class="application">
          <a href="/recruitment/{{ $recruit->id }}/form">応募する</a>
      </div>
    </body>
</html>

</x-app-layout>