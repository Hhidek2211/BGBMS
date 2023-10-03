<x-app-layout>
  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
    </head>
 
 {{--
    やりたいこと
    １．onchangeによって、bandmember[]が選択されたことを判定
    ２．選ばれたbandmember[]の要素のうち、
        ・どのuser->idが選択されたのか
        ・６つあるbandmember[]タグのうち、どれが選択されたのかを判定
    ３．選ばれたuser->idをもとに、該当idを持つUserProfileのレコードとリレーションされているinstrumentsのレコードを取得
    ４．取得したレコードをmemberinst[]のうち、選択されたbandmember[]と同じ番号のもののオプションとして変更する
    ５．これらをすべて読み込みなしで行う
 --}}
 
    <body>
        <div class="w-1/2 text-center text-2xl text-white bg-blue-300 border-white border-2 rounded-full mx-auto my-4">
            バンド作成
        </div>
        <div class="container w-4/5 mx-auto text-center border border-4 border-gray-300 rounded-xl bg-white">
            <form action="{{ route('bandstore') }}" method="POST" >
            @csrf
                <div id="name" class="mx-4 my-3 text-left">
                    <h2 class="text-lg">バンド名</h2>
                    <p class="text-sm text-gray-500">既存のバンドと同じ名前は使えません</p>
                    <input class="w-full" type="text" name="editband[name]" value="{{ old('editband.name') }}">
                    <p class="error_name" style="color:red">{{ $errors->first('editband.name') }}</p>
                </div>
                
                <div class="flex mx-4 my-3 space-x-4">
                    <div id="member" class="w-1/4 text-left">
                        <h2 class="text-lg">メンバー</h2>
                        <p class="text-sm text-gray-500">バンドメンバーと担当楽器を選択</p>
                        @for ($i = 0; $i < 6; $i++)
                            <p class="whitespace-nowrap">
                                <select class="w-3/4" name="bandmember[{{$i}}]" id="{{$i}}">
                                @if($i == 0)
                                    <option value="{{ $loginuser->id }}">{{ $loginuser->name }}</option>
                                 @else
                                    <option value="">未指定</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" name="memberid">{{ $user->name }}</option>
                                    @endforeach
                                @endif
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
                        <textarea class="w-full h-1/2" type="text" name="editband[introduction]" value="{{ old('editband.introduction') }}"></textarea>
                        <p class="error_introduction" style="color:red">{{ $errors->first('editband.introduction') }}</p>
                    </div>
                </div>
                <input class="pb-3 text-xl" type="submit" value="作成する">
            </form>
        </div>

        <script>
            $.ajaxSetup({
                headers:{ 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") }
            })
            $('.bandmember[]').on('change', function(){
                var idx = obj.selectedIndex;
                var value = obj.options[idx].value;
                var name = obj.name;
                var selectnumber = obj.id
                console.log(name + selectnumber);
            
                $.ajax({
                    url:"{{ route('getuserinst') }}",
                    method: "POST",
                    data: { value : value },
                    dataType:"json",
                }).done(function(res){
                
            })
            })
        </script> 
        
 {{--      <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
        })
        $('.member').on('change', function(){
            memberid = $('option[name="memberid"]').val();
            $.ajax({
                url: "{{ route('getuserinst') }}",
                method: "POST",
                data: { memberid : memberid },
                dataType: "json",
            }).done(function(res){
                    console.log(res);
                    $('ul').append('<li>'+ res + '</li>');
            }).faile(function(){
                alert('通信の失敗をしました');
            });
        });
       </script> --}}
       
        
    </body>
</html>

</x-app-layout>