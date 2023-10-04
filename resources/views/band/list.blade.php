<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    
    <body>
        <div id="userband">
            <div class="w-1/2 text-center text-2xl text-white bg-blue-300 border-white border-2 rounded-full mx-auto my-4">あなたのバンド</div>
            <div class="container w-full md:w-2/3 mx-auto text-center">
                <div class="grid md:grid-cols-2 px-4 py-3 gap-x-3 gap-y-2">
                    @foreach($userbands as $band)
                        <a id="bandname" class="block w-full h-10 px-3 border border-3 border-gray-300 bg-white rounded-full text-xl" href="{{ route('bandpage', ['band'=> $band->id]) }}">{{ $band->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>

</x-app-layout>