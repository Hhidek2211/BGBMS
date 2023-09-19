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
                <p>
                 <select name="bandmember[{{$i}}]" id="{{$i}}">
                  <option value="">未指定</option>
                  @foreach($users as $user)
                    <option value="{{ $user->id }}" name="memberid">{{ $user->name }}</option>
                  @endforeach
                 </select>
                 <select name="memberinst[{{$i}}]" class="memberinst">
                     
                 </select>
                </p>
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