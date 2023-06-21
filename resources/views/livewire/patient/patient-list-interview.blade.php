<div class="w-full lg:block">
    <small>
         <div class="p-8 border bg-gray-100 rounded-lg">
        <ul class="mx-auto">
            <h1 class="border rounded font-bold text-center py-2 uppercase text-gray-700 bg-white">{{ __('list of interviews') }}</h1>

            @foreach ($interviews as $i )
                <li class="flex items-center border rounded my-3 py-2 bg-white cursor-pointer">
                    <p>
                        <a href="{{ route('interviews.detail',$i->id) }}"
                         class="mx-1 font-bold text-gray-700 hover:underline">
                              {{ $i->Doctor }}
                        </a>
                        <small>{{  \Carbon\Carbon::parse($i->date)->format('d-m-Y') }}</small>
                    </p>
                    </li>
            @endforeach

            @if ($interviews->count() > 0)
            <div class="flex justify-between text-xs">
                {{ $interviews->links() }}
            </div>
            @endif

        </ul>
    </div>
    </small>

</div>
