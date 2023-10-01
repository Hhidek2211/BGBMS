<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    
    <body>
       <p1>ユーザープロフィール作成</p1>
       <form action="{{ route('user_store') }}" method="POST" >
        @csrf
        <nobr>
            <div class="name">
             <h2>ユーザー名</h2>
             <input type="text" name="edituser[name]" value="{{ old('edituser.name') }}">
             <p class="error_name" style="color:red">{{ $errors->first('edituser.name') }}</p>
            </div>
            
            <div class="grade">
             <h2>学年</h2>
             <input type="number" name="edituser[grade]" value="{{ old('edituser.grade') }}">
             <p class="error_grade" style="color:red">{{ $errors->first('edituser.grade') }}</p>
            </div>
        </nobr>
        
            <div class="instrument">
                <h2>楽器</h2>
                @foreach ($instruments as $instrument)
                <label>
                <input type="checkbox"  value="{{ $instrument->id }}" name="instruments[]">
                    {{ $instrument->name }}
                </input>
                </label>
                @endforeach
                
            </div>
            
            <div class="introduction">
             <h2>自己紹介</h2>
             <textarea type="text" name="edituser[introduction]" value="{{ old('edituser.introduction') }}"></textarea>
             <p class="error_introduction" style="color:red">{{ $errors->first('edituser.introduction') }}</p>
            </div>
            
            <div class="id">
                <input type="hidden" name="edituser[user_id]" value="{{$user->id}}" >
                <p class="error_id" style="color:red">{{ $errors->first('edituser.user_id') }}</p>
            </div>
            
            <input type="submit" value="store">
       </form>
       
    </body>
</html>

</x-app-layout>