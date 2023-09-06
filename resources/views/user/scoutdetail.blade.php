<x-app-layout>
  <!DOCTYPE html>
    <body>
     <h1>{{ $band->name }}さんからのスカウト</h1>
     <h2>バンドについての情報</h2>
     <p>バンドメンバー</p>
      @foreach( $band->user_profiles as $member)
        <p>{{ $member->name }}</p>
      @endforeach
     <br>
     <p>バンド紹介</p>
      <p>{{ $band->introduction }}</p>
     <br>
     <h2>スカウトの情報</h2>
      <p>タイトル：{{ $scout->title }}</p>
      <p>メッセージ：</p>
      <p>{{ $scout->message }}</p>
      
      <div class="approve">
        <form action="{{ route('scout_approve', ['user'=> $user->id, 'scout'=> $scout->id]) }}" method="POST">
          @csrf
          @method('PUT')
          <input type="submit" value="スカウトを承認する">
      </div>
    </body>
</html>

</x-app-layout>