<section>
    <div class="mx-20 my-2">
        <button class="rounded w-full bg-green-500 text-white hover:bg-green-400 px-4 py-2" wire:click="$set('openModal',true)">
            {{ __('add specialty') }}
        </button>
    </div>
    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('add specialty') }}
            </div>
            <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/banner-medical.jpg') }}"
                alt="{{ auth()->user()->name }}">
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 gap-6 border p-3">
                <div class="buscador col-span-2 mx-20">
                    <input class=" w-full rounded" placeholder="{{ __('find specialty') }}" type="text"
                        wire:model="search">
                </div>
                <div class="w-full bg-blue-400 p-2 border-2 border-white text-white font-medium uppercase">{{ __('specialties') }}</div>
                <div class="w-full bg-blue-400 p-2 border-2 border-white text-white font-medium uppercase">{{ auth()->user()->name }}</div>
                <div class="aseleccionar ">
                    @forelse ($specialties as $s)
                        <div>
                            <input value="{{ $s->id }}" type="checkbox" wire:change="modify({{ $s->id }})"><span class="mx-2">{{ $s->name }}</span>
                        </div>
                    @empty
                    <div class="w-full bg-blue-400 p-2 border-2 border-white text-white font-medium uppercase">{{ __('no register specialties') }}</div>
                    @endforelse
                 </div>
                <div class="seleccionadas">
                    @foreach ($user_specialties as $us)
                        <div>
                            <input value="{{ $us->id }}" type="checkbox" wire:change="del({{ $us->id }})"><span class="mx-2">{{ $us->name }}</span>
                        </div>
                    @endforeach

                </div>
            </div>
        </x-slot>
        <x-slot name="footer">

            <button class="bg-green-500 text-white hover:bg-red-400 px-4 py-2 rounded" wire:click="$set('openModal',false)">
                {{ __('ok') }}
            </button>
        </x-slot>
    </x-dialog-modal>
</section>
