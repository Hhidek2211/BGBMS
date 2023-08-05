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
       <form action="/user/edituser" method="POST" >
        @csrf
            <div class="name">
             <h2>ユーザー名</h2>
             <input type="text" name="edituser[name]">
            </div>
            
            <div class="grade">
             <h2>学年</h2>
             <input type="text" name="edituser[grade]">
            </div>
            
            <div class="introduction">
             <h2>自己紹介</h2>
             <textarea type="text" name="edituser[introduction]"></textarea>
            </div>
            
            <div class="id">
                <input type="hidden" name="edituser[user_id]" value="{{$user->id}}" >
            </div>
            
            <input type="submit" value="store">
       </form>
       
    </body>
</html>

</x-app-layout>