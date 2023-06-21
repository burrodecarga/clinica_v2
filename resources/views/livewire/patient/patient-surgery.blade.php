<div>
    <header class="px-5 py-4 border-b border-gray-100 bg-white">
        <h2 class="font-bold text-center text-gray-800 capitalize text-2xl mb-2 flex justify-between items-center">
       <span class="text-red-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" />
          </svg>
            </span>
            <span class="font-bold text-sm text-gray-500">
                {{ __('surgery history') }}
            </span>
        </h2>
        <ul class="w-full">
            @foreach ($patient_surgeries as $pd)
                <li class="mb-1"><a class="block cursor-pointer px-3 py-2 bg-blue-400 hover:bg-blue-700 text-white">{{ $pd->name }}</a></li>
            @endforeach
        </ul>
    </header>
    <div class="bg-white p-3">
        <input class="w-full rounded" type="text" placeholder="search surgery" wire:model="search" />
        <ul class="w-full">
            @forelse($surgeries as $surgery)
                <li class="cursor-pointer px-3 py-2 bg-gray-400 hover:bg-gray-500 text-black my-2 bolck"><a
                        wire:click="addModalSurgery({{ $surgery->id }})">{{ $surgery->name }}</a></li>
            @empty
                @if (strlen(trim($this->search)) > 8)
                    <h3 class="bg-red-500 text-white p-2 w-full mt-2 text-center font-bold">
                        {{ __('no search result') }}</h3>
                    <div class="bg-blue-500 text-white text-center p-2 my-2">
                        <button wire:click="addNew">{{ __('¿ want add this') }}
                            <br>
                            <strong class="text-xl">{{ __($this->search) }}</strong>
                            <br>
                            <p>{{ __('to list ...?') }}</p>
                        </button>

                    </div>
                @endif
            @endforelse
        </ul>
    </div>

    <x-dialog-modal wire:model="modal">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('add surgery to patient history') }}
            </div>
            <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/especialidades.jpg') }}" alt="">
        </x-slot>
        <x-slot name="content">
            <div class="flex gap-2">
                <div class="w-3/4">
                    <input class="w-full rounded cursor-pointer" type="text" placeholder="{{ __('name') }}"
                        wire:model="name" />
                    <x-input-error for="name" />
                </div>
                <div>
                    <input class="w-full rounded cursor-pointer" type="number" placeholder="{{ __('surgery year') }}"
                        wire:model="year" />
                    <x-input-error for="year" />
                </div>
            </div>
            <input type="hidden" wire:model="surgery_id">
        </x-slot>
        <x-slot name="footer">
            <button class="bg-red-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-3"
                wire:click="$set('modal',false)">
                {{ __('cancel') }}
            </button>
            <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3" wire:click="addSurgery">
                {{ __('add surgery') }}
            </button>

        </x-slot>
    </x-dialog-modal>
</div>
