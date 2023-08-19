<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

        <title>Laravel</title>
    </head>
    
    <body>
      <h1>現在募集中のバンド</h1>
      
      <div class="bandlist">
          @foreach ($bands as $band)
            <div class="title">
                <a href="/recruitment/list/{{ $band->recruitment->id }}">{{ $band->recruitment->title }}</a>
            </div>
            <div class="name">
                <p>募集者：{{ $band->name }}</p>
            </div>
          @endforeach
      </div>
    </body>
</html>

</x-app-layout>