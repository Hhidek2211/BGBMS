<x-app-layout>
  <!DOCTYPE html>
    <body>
      <h1>スカウトを作成する - ユーザーの詳細</h1>
      <div class="userprofile">
        <h2>{{ $user->name }}さん   {{ $user->grade }}回生</h2>
        <p>担当可能楽器</p>
         @foreach($user->instruments as $inst)
             <p>{{ $inst->name }}</p>
         @endforeach
        <p>自己紹介</p>
        <p>{{ $user->introduction }}</p>
      </div>
      <br>
      <div class="createScout">
        <a href="{{ route('scout_create', ['band'=> $band, 'user'=> $user]) }}">スカウトする！</a>
      </div>
    </body>
</x-app-layout>