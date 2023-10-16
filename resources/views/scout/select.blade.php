<x-app-layout>
  <!DOCTYPE html>
    <body>
      <div class="w-11/12 md:w-1/2 text-center text-2xl text-white bg-blue-300 border-white border-2 rounded-full mx-auto my-4">
        スカウト相手の選択
      </div>
      <div id="instSelect" class="container w-11/12 md:w-2/5 mx-auto text-center border border-4 border-gray-300 rounded-xl bg-white px-2 py-3 mb-4">
        <p class="text-lg">スカウトしたい楽器を選択</p>
        <div class="grid grid-cols-3 md:grid-cols-6 gap-2">
          @foreach ($insts as $inst)
            <form class="border border-gray-300 border-2 rounded-lg block" action="{{ route('scout_userselect_reload', ['band'=> $band->id]) }}" type="GET">
            @csrf
              <div class="block">
                <input type="hidden" value="{{ $inst->id }}" name="loopinstid">
                <input type="submit" value="{{ $inst->name_abb }}">
              </div>
            </form>
          @endforeach
        </div>
      </div>
      <div class="w-11/12 md:w-2/5 mx-auto">
        <div class="flex flex-col">
          <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
              <div class="border rounded-lg overflow-hidden border-gray-300 border-4 bg-white">
                <table class="min-w-full divide-y divide-gray-300">
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase dark:text-gray-400">名前</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase dark:text-gray-400">学年</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase dark:text-gray-400">担当可能楽器</th>
                    </tr>
                  </thead>
                  @foreach ($usersbyinst[$loopinstid] as $user)
                    <tbody class="divide-y divide-gray-300 text-left">
                      <tr>
                        <th class="px-6 py-2"><a href="{{ route('scout_userdetail', ['band'=> $band->id, 'user'=> $user->id]) }}">{{ $user->name }}</a></th>
                        <th class="px-6 py-2">{{ $user->grade }}</th>
                        <th class="px-6 py-2"> 
                          @foreach($user->instruments as $inst)
                            {{ $inst->name_abb }}
                          @endforeach
                        </th>
                      </tr>
                    </tbody>
                  @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
  </body>
</x-app-layout>