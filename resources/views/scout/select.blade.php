<x-app-layout>
  <!DOCTYPE html>
    <body>
      <h1>スカウトを作成する</h1>
      <div class="selectinst">
        <nobr>
        @foreach ($insts as $inst)
        <form action="{{ route('scout_userselect_reload', ['band'=> $band->id]) }}" type="GET">
        @csrf
            <input type="hidden" value="{{ $inst->id }}" name="loopinstid">
            <input type="submit" value="{{ $inst->name }}">
        </form>
        @endforeach
        </nobr>
      </div>
      <div class="usertable">
        @foreach ($usersbyinst[$loopinstid] as $user)
            <table class="usertable">
                 <th><a href="{{ route('scout_userdetail', ['band'=> $band->id, 'user'=> $user->id]) }}">{{ $user->name }}</a></th>
                 <th>{{ $user->grade }}回生</th>
            </table>
        @endforeach
      </div>
    </body>
</x-app-layout>