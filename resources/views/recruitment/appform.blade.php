<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

        <title>Laravel</title>
    </head>
    
    <body>
       <h1>{{ $band->name }}の募集に応募する</h1>
       <div class="appform">
        <form action="{{ route('application', ['recruit'=> $recruit->id ]) }}" method="POST">
        @csrf  
            <div class="appinsts">
                <h2>応募する楽器</h2>
                @foreach($insts as $inst)
                    <input type="radio" name="application[appinstid]" value="{{ $inst->id }}">{{ $inst->name }}</input>
                @endforeach
            </div>
            <div class="message">
                <h2>メッセージ</h2>
                <textarea name="application[message]"></textarea>
            </div>
            <input type="submit" value="送信する">
            <div class="userid">
                <input type="hidden" name="application[user_profile_id]" value="{{ $user->id }}">
            </div>
        </form>
       </div>    
    </body>
</html>

</x-app-layout>