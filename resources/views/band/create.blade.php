<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    
    <body>
       <h1>バンド作成</h1>
       <form action="{{ route('bandstore') }}" method="POST" >
        @csrf
            <div class="name">
             <h2>バンド名</h2>
             <input type="text" name="editband[name]" value="{{ old('editband.name') }}">
             <p class="error_name" style="color:red">{{ $errors->first('editband.name') }}</p>
            </div>
            
            <div class="member">
            <h2>メンバー</h2>
            
            @for ($i = 0; $i < 6; $i++)
              
                <p><select name="bandmember[]">
                    <option value="">未指定</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select></p>
            @endfor
                <p class="error_member" style="color:red">{{ $errors->first('bandmember') }}</p>
            </div>
            
            <div class="introduction">
             <h2>自己紹介</h2>
             <textarea type="text" name="editband[introduction]" value="{{ old('editband.introduction') }}"></textarea>
             <p class="error_introduction" style="color:red">{{ $errors->first('editband.introduction') }}</p>
            </div>
            
            <input type="submit" value="store">
       </form>
    </body>
</html>

</x-app-layout>