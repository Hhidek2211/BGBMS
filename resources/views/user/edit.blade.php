<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    
    <body>
        <p1>ユーザープロフィール編集</p1>
       <form action="{{ route('user_update', ['user'=> $user->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <nobr>
            <div class="name">
             <h2>ユーザー名</h2>
             <input type="text" name="edituser[name]" value="{{ $user->name }}">
             <p class="error_name" style="color:red">{{ $errors->first('edituser.name') }}</p>
            </div>
            
            <div class="grade">
             <h2>学年</h2>
             <input type="number" name="edituser[grade]" value="{{ $user->grade }}">
             <p class="error_grade" style="color:red">{{ $errors->first('edituser.grade') }}</p>
            </div>
        </nobr>
        
            <div class="instrument">
                <h2>楽器</h2>
                @foreach ($instruments as $instrument)
                {{--@php dd($instrument, $user, $inst) @endphp --}}
                <lavel>
                    @if ( in_array($instrument->id, $userinstids))      {{-- ユーザーが登録した楽器のみ初期選択状態にする --}}
                    <input type="checkbox" value="{{ $instrument->id }}" name="instrument[]" checked>
                            {{ $instrument->name }} 
                    @else 
                    <input type="checkbox" value="{{ $instrument->id }}" name="instrument[]">
                            {{ $instrument->name}}
                    @endif
                </label>            
                @endforeach
                
            </div>
            
            <div class="introduction">
             <h2>自己紹介</h2>
             <input type="text" name="edituser[introduction]" value="{{ $user->introduction }}">
             <p class="error_introduction" style="color:red">{{ $errors->first('edituser.introduction') }}</p>
            </div>
            
            <div class="id">
                <input type="hidden" name="edituser[user_id]" value="{{$user->id}}" >
                <p class="error_id" style="color:red">{{ $errors->first('edituser.user_id') }}</p>
            </div>
            
            <input type="submit" value="update">
       </form>
    </body>
</html>

</x-app-layout>