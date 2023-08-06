<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    
    <body>
       <p1>バンド作成</p1>
       <form action="/band/editband" method="POST" >
        @csrf
            <div class="name">
             <h2>バンド名</h2>
             <input type="text" name="editband[name]">
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
            </div>
            
            <div class="introduction">
             <h2>自己紹介</h2>
             <textarea type="text" name="edituser[introduction]"></textarea>
            </div>
            
            <input type="submit" value="store">
       </form>
       
    </body>
</html>

</x-app-layout>