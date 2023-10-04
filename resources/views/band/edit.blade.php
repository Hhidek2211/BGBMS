<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    
    <body>
        
        {{--@php
            dd($band)
        @endphp--}}
        
       <div class="w-1/2 text-center text-2xl text-white bg-blue-300 border-white border-2 rounded-full mx-auto my-4">
           バンドプロフィール編集
        </div>
        <div class="container w-4/5 mx-auto text-center border border-4 border-gray-300 rounded-xl bg-white">
            <form action="{{ route('bandupdate', ['band'=> $band->id]) }}" method="POST" >
            @csrf
            @method('PUT')
                <div id="name" class="mx-4 my-3 text-left">
                    <h2 class="text-lg">バンド名</h2>
                    <p class="text-sm text-gray-500">既存のバンドと同じ名前は使えません</p>
                    <input class="w-full" type="text" name="editband[name]" value="{{ $band->name }}">
                    <p class="error_name" style="color:red">{{ $errors->first('editband.name') }}</p>
                </div>
            
                <div class="flex mx-4 my-3 space-x-4">
                    <div id="member" class="w-1/4 text-left">
                        <h2 class="text-lg">メンバー</h2>
                        <p class="text-sm text-gray-500">バンドメンバーと担当楽器を選択</p>
                        @php $i = 0 @endphp
                        @foreach($members as $member)
                            <p class="whitespace-nowrap">
                                <select class="w-3/4" name="bandmember[]">
                                    <option value="{{ $member->id }}" hidden>{{ $member->name }}</option>
                                    <option value="">未指定</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <select class="w-1/4" name="memberinst[{{$i}}]" class="memberinst">
                                </select>
                            </p>
                            @php $i++ @endphp
                        @endforeach
                        @for ($i; $i < 6; $i++)
                            <p class="whitespace-nowrap">
                                <select class="w-3/4" name="bandmember[]">
                                    <option value="">未指定</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <select class="w-1/4" name="memberinst[{{$i}}]" class="memberinst">
                                </select>
                            </p>
                        @endfor
                        <p class="error_member" style="color:red">{{ $errors->first('bandmember') }}</p>
                    </div>
            
                    <div class="w-3/4 text-left" id="introduction">
                        <h2 class="text-lg">バンド紹介文</h2>
                        <p class="text-sm text-gray-500">どんな曲をやるのか、バンドの雰囲気などを書いてみよう</p>
                        <textarea class="w-full h-1/2" type="text" name="editband[introduction]">{{ $band->introduction }}</textarea>
                        <p class="error_introduction" style="color:red">{{ $errors->first('editband.introduction') }}</p>
                    </div>
                </div>
                <input class="pb-3 text-xl" type="submit" value="保存する">
            </form>
        </div>
    </body>
</html>

</x-app-layout>