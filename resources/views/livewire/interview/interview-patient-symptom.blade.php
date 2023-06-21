<div class="px-3 py-2">
    <a wire:click="$set('openModal', 'true')"
        class="cursor-pointer font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Motivo de Consulta</a>

   <x-jet-dialog-modal wire:model="openModal" wire:submit.self="save">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('add symptom') }}

            </div>
            <img class="h-24 w-full object-center object-cover" src="{{ asset('assets/banner-medical.jpg') }}"
                alt="{{ auth()->user()->name }}">
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2">
                <div class="buscador col-span-2 mb-1">
                    <input class=" w-full rounded" placeholder="{{ __('find symptom') }}" type="text"
                        wire:model="search">
                </div>
                <div class="w-full bg-blue-400 p-2 border-2 border-white text-gray-800">{{ __('symptoms') }}</div>
                <div class="w-full bg-blue-400 p-2 border-2 border-white text-gray-800">{{ auth()->user()->name }}</div>
                <div class="aseleccionar">
                    @forelse ($arraySymptom as $s)
                        <div>
                            <input value="{{ $s->id }}" type="checkbox"
                                wire:change="modify({{ $s->id }})"><span
                                class="ml-4">{{ $s->name }}</span>
                        </div>
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
                                    <p>{{ __('push OK') }}</p>
                                </button>

                            </div>
                        @endif
                    @endforelse

                </div>
                <div class="seleccionadas">
                    @foreach ($user_symptoms as $key=>$us)
                        <div>
                            <input value="{{ $us }}" type="checkbox"
                                wire:change="del({{ $key }})" key="{{ $us }}"/>
                                <span class="ml-4">{{ $us }}--{{ $key }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button class="bg-yellow-500 text-white hover:bg-red-400 px-4 py-2 rounded"
                wire:click="$set('openModal',false)">
                {{ __('cancel') }}
            </button>
            <button class="bg-green-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-6" type="submit"
                wire:click="save">
                {{ __('ok') }}
            </button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
