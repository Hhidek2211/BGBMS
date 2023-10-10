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
        現在の募集一覧
      </div>
      <div class="container w-full md:w-3/4 mx-auto">
        <div id="bandlist" class="grid md:grid-cols-2 md:gap-x-3 gap-y-2">
          {{--@if(isset($recruits))--}}
            @php $b = 0 @endphp
            @foreach ($bands as $band)
              @php $b++ @endphp
              <div id="recruitBand" class="border border-2 border-gray-400 bg-white rounded-xl px-2 md:px-3 py-3">
                <div id="title" class="text-center text-xl"> 
                    <a href="{{ route('recruitdetail', ['recruit'=> $band->recruitment->id]) }}">{{ $band->recruitment->title }}</a>
                </div>
                <div id="name" class="px-3 text-right">
                    <p>By:{{ $band->name }}</p>
                </div>
                <div class="text-center">
                  <p>募集楽器</p>
                  <div id="insts" class="flex justify-center space-x-6">
                    @php $i = 0 @endphp
                    @foreach($insts as $inst)
                      @php  $i++  @endphp
                      <div id="{{ $b }}{{ $i }}" class="text-gray-400">{{ $inst->name_abb }}</div>
                      @foreach($band->recruitment->instruments as $recInst)
                       <script>
                         var id = "{{ $b }}{{ $i }}"
                         var instId = {{ $i }};
                         var recInstId = {{$recInst->id}};
                         if(instId == recInstId) {
                          document.getElementById(id).style.color = "black"   
                         }
                       </script>
                      @endforeach
                    @endforeach
                  </div>
                </div>
              </div>
            @endforeach
        </div>
      </div>
    </body>
</html>

</x-app-layout>