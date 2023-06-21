<div class="px-3 py-2">
    <a wire:click="$set('openModal', 'true')"
        class="cursor-pointer font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Chequeo
        Médico</a>

    <x-jet-dialog-modal wire:model="openModal" wire:submit.self="save">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('parámetros fisiológicos') }}

            </div>
            <img class="h-24 w-full object-center object-cover" src="{{ asset('assets/banner-medical.jpg') }}"
                alt="{{ auth()->user()->name }}">
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 gap-3">
                <div class="buscador col-span-2 mb-1">
                    <input class=" w-full rounded" placeholder="{{ __('find check') }}" type="text"
                        wire:model="search">
                </div>
                <div class="w-full bg-blue-400 p-2 border-2 border-white text-gray-800 mb-2">{{ __('parámetro') }}</div>
                <div class="w-full bg-blue-400 p-2 border-2 border-white text-gray-800 mb-2">
                    {{ __('valor asignado') }}</div>
                <div class="aseleccionar">
                    @forelse ($arrayKey as $s)
                        <div class="w-full border mb-1">
                            <button wire:click="modify({{ $s->id }})" class="cursor-pointer"
                                title="{{ 'agregar ' . $s->name . ' a paciente' }}">
                                <i class="fa-solid fa-tachograph-digital text-green-500 mx-2"></i>
                                <span
                                    class="font-bold mx-2">
                                    {{ $s->name . '  ' }}<small>({{ $s->unit }})</small></span>



                                </button>
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

                    @forelse($arrayUserData as $d)
                        <div class="border mb-1">
                            <button wire:click="delete({{ $d['key_id'] }})">
                                <i class="fa-solid fa-trash-can text-red-600 mx-2" title="{{ 'eliminar ' . $d['name'] . ' a paciente' }}"></i>
                            </button>
                            <a class="cursor-pointer"
                                >
                                <span
                                    class="ml-4 font-bold">{{ $d['name'] . '  : ' . $d['value_num'] . ' ' }}</span><small>({{ $d['unit'] }})</small>
                            </a>

                        </div>

                    @empty
                        <div class="border mb-1">
                            <a class="cursor-pointer">
                                <span class="ml-4 font-bold">No hay registro de parámetros</span> </a>
                        </div>
                    @endforelse

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
                {{ __('update') }}
            </button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="modalKey" wire:submit.self="saveKey">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('add parameter') }}

            </div>
            <img class="h-24 w-full object-center object-cover" src="{{ asset('assets/banner-medical.jpg') }}"
                alt="{{ auth()->user()->name }}">
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2">
                <div class="seleccionadas">
                    <div>
                        <label for="value_num">Parámetro {{ $name }} <small>{{ $unit }}</small>
                        </label>
                        <input class="w-full rounded" type="text" placeholder="{{ $name }}"
                            wire:model="value_num" />
                        <x-jet-input-error for="value_num" />
                    </div>
                </div>

            </div>
        </x-slot>
        <x-slot name="footer">
            <button class="bg-yellow-500 text-white hover:bg-red-400 px-4 py-2 rounded" wire:click="resetKey">
                {{ __('cancel') }}
            </button>
            <button class="bg-green-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-6" type="submit"
                wire:click="modifyKey({{ $keyId }})">
                {{ __('register') }}
            </button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
