<div class="w-full lg:block">
    @if($user->pregnants()->where('active',1)->first())
    <button wire:click="generar" class="px-3 py-1 bg-green-500 text-white rounded mb-3 mx-auto">generar control de embarazo</button>
    @endif
    <small>
         <div class="p-8 border bg-gray-100 rounded-lg">
        <ul class="mx-auto">
            <h1 class="border rounded font-bold text-center py-2 uppercase text-gray-700 bg-white">{{ __('list of appoinments') }}</h1>


    @forelse ($appoinments as $a )

    <p>{{ \Carbon\Carbon::parse($a->date)->format('d-m-Y') }}
    <small>{{ $a->description }}</small></p>
    @empty
    <p class="text-center text-gray-500 my-6">NO HAY CITAS REGISTRADAS</p>
    @endforelse
        </ul>
    </small>
</div>
