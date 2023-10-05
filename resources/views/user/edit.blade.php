<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    
    <body>
        <div class="w-11/12 md:w-1/2 text-center text-2xl text-white bg-blue-300 border-white border-2 rounded-full mx-auto my-4">
            ユーザープロフィール編集
        </div>
        <div class="container w-4/5 mx-auto text-center border border-4 border-gray-300 rounded-xl bg-white">
            <form action="{{ route('user_update', ['user'=> $user->id]) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="flex flex-wrap md:mx-20 my-3 text-left space-y-1 md:space-y-0">
                    <div id="name" class="w-full mx-2 md:w-3/4 md:mr-1">
                        <h2 class="text-lg">ユーザー名</h2>
                        <p class="text-sm text-gray-500">ほかのユーザーに表示する名前です 本名を入力してください</p>
                        <input class="w-full" type="text" name="edituser[name]" value="{{ $user->name }}">
                        <p class="error_name" style="color:red">{{ $errors->first('edituser.name') }}</p>
                    </div>
            
                    <div id="grade" class="w-full mx-2 md:mr-1 md:w-1/5">
                        <h2 class="text-lg">学年</h2>
                        <p class="text-sm text-gray-500">半角数字で入力して下さい</p>
                        <input class="w-full" type="number" name="edituser[grade]" value="{{ $user->grade }}">
                        <p class="error_grade" style="color:red">{{ $errors->first('edituser.grade') }}</p>
                    </div>
                </div>
        
                <div class="flex flex-wrap md:mx-20 my-3 text-left space-y-1 md:space-y-0">
                    <div id="instrument" class="w-full md:w-1/3 mx-2">
                        <h2 class="text-lg">担当可能楽器</h2>
                        <p class="text-sm text-gray-500 mb-1">担当できる、担当したい楽器を登録してください<br>スカウトに使用します</p>
                        <div class="grid grid-cols-2 gap-x-2">
                            @foreach ($instruments as $instrument)
                                    @if ( in_array($instrument->id, $userinstids))      {{-- ユーザーが登録した楽器のみ初期選択状態にする --}}
                                        <lavel>
                                            <input type="checkbox" value="{{ $instrument->id }}" name="instrument[]" checked>
                                                {{ $instrument->name_jp }}
                                            </input>
                                        </lavel>
                                    @else 
                                        <lavel>
                                            <input type="checkbox" value="{{ $instrument->id }}" name="instrument[]">
                                                {{ $instrument->name_jp }}
                                            </input>
                                        </lavel>
                                    @endif
                                </label>            
                            @endforeach
                        </div>
                    </div>
            
                    <div id="introduction" class="w-full md:w-3/5 mx-2">
                        <h2 class="text-lg">自己紹介</h2>
                        <p class="text-sm text-gray-500 mb-1">あなた自身のこと、好きな曲などを書きましょう（200字以内）</p>
                        <textarea class="w-full h-5/6" type="text" name="edituser[introduction]" value="{{ $user->introduction }}"></textarea>
                        <p class="error_introduction" style="color:red">{{ $errors->first('edituser.introduction') }}</p>
                    </div>
                </div>
            
                <div id="id">
                    <input type="hidden" name="edituser[user_id]" value="{{$user->id}}" >
                    <p class="error_id" style="color:red">{{ $errors->first('edituser.user_id') }}</p>
                </div>
            
                <input class="mt-8 mb-3" type="submit" value="保存する">
           </form>
       </div>
    </body>
</html>

</x-app-layout>