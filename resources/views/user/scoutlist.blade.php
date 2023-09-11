<x-app-layout>
  <!DOCTYPE html>
    <body>
     <h1>あなたへのスカウト一覧</h1>
     @foreach( $scouts as $scout )
        <a href="{{ route('scout_detail', ['user'=> $user->id, 'scout'=> $scout->id ]) }}">{{ $scout->band_profile->name }}さん</a>
        <p>依頼楽器：{{ $scout->instrument->name_abb}}</p>
     @endforeach
    </body>
</html>

</x-app-layout>