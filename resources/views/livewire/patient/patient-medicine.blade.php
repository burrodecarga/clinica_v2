<div class="bg-gray-200 p-4">
    <h1 class="text-center px-4 py-2 border bg-white font-bold text-sm uppercase mb-4 text-gray-500">{{ __('patients medicine') }}</h1>

    <button class="my-2 px-4 py-2 text-white w-full bg-blue-500 hover:bg-blue-700"
        wire:click="$set('openModal',true)">{{ __('prescribe medicine') }}</button>
    <div>
        <ul class=" w-full bg-white">
            @foreach ($patient_medicines as $m)
                <li class="w-full border shadow px-4 py-2">
                    <a class="cursor-pointer text-gray-500"
                        wire:click="edit({{ $m->id }})">
                       <strong>
                        {{ $m->name }}
                    </strong>
                    </a>
                    <hr>
                    <p class="text-gray-600 text-sm"><strong>{{ __('dosage') }}</strong> :{{ $m->pivot->dosage }}</p>
                    <hr>

                    <p class="text-gray-800 text-sm italic"><strong>{{ __('instruction') }}</strong> :{{ $m->pivot->instruction }}</p>
                    <a wire:click="del({{ $m->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z" />
                        </svg>
                    </a>
                </li>
            @endforeach
        </ul>

    </div>

    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('add medicine') }}
            </div>
            <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/medicines.jpg') }}" alt="">
        </x-slot>
        <x-slot name="content">
            <div class="space-y-3">
                <div>
                    <select wire:model="medicine_id" class="w-full rounded cursor-pointer" type="text"
                        placeholder="{{ __('select medicine') }}" />
                    <option value="">{{ __('select medicine') }}</option>
                    @foreach ($medicines as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                    @endforeach
                    </select>
                    <x-input-error for="medicine_id" />
                </div>
                <div>
                    <input wire:model="dosage" class="w-full rounded cursor-pointer" type="text"
                        placeholder="{{ __('input dosage') }}" />
                    <x-input-error for="dosage" />
                </div>
                <div>
                    <textarea wire:model="instruction" class="w-full rounded cursor-pointer" type="text"
                        placeholder="{{ __('input instruction') }}"></textarea>
                    <x-input-error for="instruction" />
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            <button class="bg-red-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-3"
                wire:click="$set('openModal',false)">
                {{ __('cancel') }}
            </button>
            <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3" wire:click="add">
                {{ __('add') }}
            </button>

        </x-slot>
    </x-dialog-modal>
    {{-- Do your work, then step back. --}}
</div>
