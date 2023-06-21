<div>
    <header class="px-5 py-4 border-b border-gray-100 bg-white">
        <h2 class="font-bold text-center text-gray-800 capitalize text-2xl mb-2 flex justify-between items-center">
            <span class="text-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                </svg>

            </span>
            <span class="font-bold text-sm text-gray-500">
                {{ __('disase history') }}
            </span>
        </h2>
        <ul class="w-full">
            @if ($patient_disases)
                @foreach ($patient_disases as $pd)
                    <li class="mb-1"><a
                            class="block cursor-pointer px-3 py-2 bg-blue-400 hover:bg-blue-700 text-white">{{ $pd->name }} : {{ $pd->pivot?->year }}</a>
                    </li>
                @endforeach
            @else
                <li class="mb-1"><a
                        class="block cursor-pointer px-3 py-2 bg-blue-400 hover:bg-blue-700 text-white">{{ __('no disases') }}</a>
                </li>
            @endif
        </ul>
    </header>
    <div class="bg-white p-3">
        <input class="w-full rounded" type="text" placeholder="{{ __('search disase') }}" wire:model="search" />
        <ul class="w-full">
            @forelse($disases as $disase)
                <li class="cursor-pointer px-3 py-2 bg-gray-400 hover:bg-gray-500 text-black my-2 bolck"><a
                        wire:click="addModalDisase({{ $disase->id }})">{{ $disase->name }}</a></li>
            @empty
                @if (strlen(trim($this->search)) > 6)
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
                {{ __('add disease to patient history') }}
            </div>
            <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/disases.jpg') }}" alt="">
        </x-slot>
        <x-slot name="content">
            <div class="flex gap-2">
                <div class="w-3/4">
                    <input class="w-full rounded cursor-pointer" type="text" placeholder="{{ __('name') }}"
                        wire:model="name" />
                    <x-input-error for="name" />
                </div>
                <div>
                    <input class="w-full rounded cursor-pointer" type="number" placeholder="{{ __('disase year') }}"
                        wire:model="year" />
                    <x-input-error for="year" />
                </div>
            </div>
            <div class="flex gap-2 mt-3 place-items-center">
                <div class="w-1/3">
                    <div class="flex items-center mb-4">
                        <input wire:model="inherited" type="checkbox" value=""
                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-checkbox"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('inherited') }}</label>
                    </div>
                    <x-input-error for="inherited" />
                </div>

                <div class="w-1/3">
                    <div class="flex items-center mb-4">
                        <input wire:model="deceased" type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-checkbox"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('deceased') }}</label>
                    </div>
                    <x-input-error for="deceased" />
                </div>

                <div class="w-1/3">

                    <select wire:model="condition" class="w-full rounded mb-4">
                        <option value="">Seleccione condición</option>
                        <option value="aguda">aguda</option>
                        <option value="crónica">crónica</option>
                    </select>
                    <x-input-error for="condition" />
                </div>
            </div>
            <div class="w-full">
                <input class="w-full rounded cursor-pointer" type="text" placeholder="{{ __('observations') }}"
                    wire:model="observation" />
                <x-input-error for="observation" />
            </div>
            <input type="hidden" wire:model="disase_id">
        </x-slot>
        <x-slot name="footer">
            <button class="bg-red-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-3"
                wire:click="$set('modal',false)">
                {{ __('cancel') }}
            </button>
            <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3" wire:click="addDisase">
                {{ __('add disase') }}
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
