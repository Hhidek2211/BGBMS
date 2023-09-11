<x-app-layout>
  <!DOCTYPE html>
    <body>
      <h1>スカウトを作成する - スカウト要項の作成</h1>
      <form action="{{ route('scout_store', ['band'=> $band->id, 'user'=> $user->id]) }}" method="POST">
      @csrf
         <div class="title"> 
            <p>スカウトのタイトル</p>
            <input type="text" name="scout[title]" value="{{ old('scout.title') }}">
            <p class="error_name" style="color:red">{{ $errors->first('scout.title') }}</p>
         </div>
         <div class="instruments">
            <p>依頼楽器</p>
            @foreach($user->instruments as $inst)
               <input type="radio" name="scout[instrument_id]" value="{{ $inst->id }}">{{ $inst->name }}</input>
            @endforeach
         </div>
         <div class="message">
            <p>メッセージ</p>
            <input type="text" name="scout[message]" value="{{ old('scout.message') }}"> 
            <p class="error_name" style="color:red">{{ $errors->first('scout.message') }}</p>
         </div>
         <div class="userid">
            <input type="hidden" name="userid" value="{{ $user->id }}">
            <input type="hidden" name="bandid" value="{{ $band->id }}">
            <p class="error_name" style="color:red">{{ $errors->first('userid') }}</p>
         </div>
            <input type="submit" value="作成する">
      </form>
    </body>
</x-app-layout>