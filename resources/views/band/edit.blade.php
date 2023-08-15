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
        
       <p1>バンド作成</p1>
       <form action="/band/{{ $band->id }}/editband" method="POST" >
        @csrf
        @method('PUT')
            <div class="name">
             <h2>バンド名</h2>
             <input type="text" name="editband[name]" value="{{ $band->name }}">
             <p class="error_name" style="color:red">{{ $errors->first('editband.name') }}</p>
            </div>
            
            <div class="member">
            <h2>メンバー</h2>
            @php $i = 0 @endphp
            @foreach($members as $member)
            {{-- @php dd($member) @endphp --}}
                <p><select name="bandmember[]">
                    <option value="{{ $member->id }}" hidden>{{ $member->name }}</option>
                    <option value="">未指定</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select></p>
                @php $i++ @endphp
            @endforeach
             {{--@php dd($i) @endphp--}}
            @for ($i; $i < 6; $i++)
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
             <input type="text" name="editband[introduction]" value="{{ $band->introduction }}">
             <p class="error_introduction" style="color:red">{{ $errors->first('editband.introduction') }}</p>
            </div>
            
            <input type="submit" value="store">
       </form>
    </body>
</html>

</x-app-layout>