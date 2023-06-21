<div class="px-3 py-2">
    <a wire:click="$set('openModal', 'true')"
        class="cursor-pointer font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Prescripción</a>

    <x-jet-dialog-modal wire:model="openModal" wire:submit.self="save">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-1 capitalize">
                {{ __('medical prescription') }}
            </div>
            <img class="h-16 w-full object-center object-cover" src="{{ asset('assets/banner-medical.jpg') }}"
                alt="{{ auth()->user()->name }}">
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 gap-2">
                <div class="buscador col-span-2 mb-1">
                    <input class=" w-full rounded" placeholder="{{ __('find medicine') }}" type="text"
                        wire:model="search">
                </div>
                <div class="w-full bg-blue-400 px-2 py-1 border-2 border-white text-gray-800 mb-1">{{ __('medicines') }}
                </div>
                <div class="w-full bg-blue-400 px-2 py-1 border-2 border-white text-gray-800 mb-1">
                    {{ __('medicines prescription') }}</div>
                <div class="aseleccionar">
                    @forelse ($medicinesArray as $s)
                        <div class="w-full border mb-1 text-xs">
                            <button wire:click="modify({{ $s->id }})" class="cursor-pointer"
                                title="{{ 'agregar ' . $s->name . ' a paciente' }}">
                                <i class="fa-solid fa-tachograph-digital text-green-500 mx-2"></i>
                                <span class="font-bold mx-2">
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

                    @forelse($medicinesArrayData as $d)
                        <div class="border mb-1">
                            <button wire:click="delete({{ $d['medicine_id'] }})">
                                <i class="fa-solid fa-trash-can text-red-600 mx-2"
                                    title="{{ 'eliminar ' . $d['name'] . ' a paciente' }}"></i>
                            </button>
                            <a class="cursor-pointer">
                                <span
                                    class="ml-4 font-bold">{{ $d['name'] . '  : '  }}</span><small>({{ $d['instruction'] }})</small>
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
            <button class="bg-yellow-500 text-white hover:bg-red-400 px-4 py-1 rounded"
                wire:click="$set('openModal',false)">
                {{ __('cancel') }}
            </button>
            <button class="bg-green-500 text-white hover:bg-red-400 px-4 py-1 rounded mx-6" type="submit"
                wire:click="save">
                {{ __('update') }}
            </button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="modalMedicine" wire:submit.self="saveMedicine" maxWidth="md">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('add prescription') }}

            </div>
            {{-- <img class="h-16 w-full object-top object-cover" src="{{ asset('assets/banner-medical.jpg') }}"
                alt="{{ auth()->user()->name }}"> --}}
        </x-slot>
        <x-slot name="content">
            <div class="bg-blue-500 p-1 text-white">
                <h1 class="text-center text-lg ">{{ $name }}</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <h1 class="mt-2 col-span-1 md:col-span-2 text-center text-sm">{{ __('DOSIFICACIÓN') }}</h1>
                <div>
                    <select wire:model="dose" class="w-full rounded text-xs">
                        <option value="">{{ __('quantity') }}</option>
                        @for ($i = 1; $i < 100; $i++)
                            <option value="{{ $i }}">dar: {{ $i }}</option>
                        @endfor
                    </select>
                    <x-jet-input-error for="dose" />
                </div>

                <div class="">
                    <select wire:model="dose_unit" class="w-full rounded text-xs">
                        <option value="">{{ __('dose') }}</option>
                        @foreach ($doses_unit as $ds)
                            @if ($dose == 1)
                                <option value="{{ $ds->unidad }}">
                                    {{ $ds->unidad }}</option>
                            @else
                                <option value="{{ $ds->plural }}">
                                    {{ $ds->plural }}</option>
                            @endif
                        @endforeach
                    </select>

                    <x-jet-input-error for="dose_unit" />
                </div>




                <h1 class="col-span-1 md:col-span-2 text-center text-sm">{{ __('FRECUENCIA') }}</h1>


                <div class="">
                    <select wire:model="num_frecuency" class="w-full rounded">
                        <option value="">{{ __('número de veces') }}</option>
                        @for ($j = 1; $j < 61; $j++)
                            <option value="{{ $j }}">cada {{ $j }}</option>
                        @endfor
                    </select>
                    <x-jet-input-error for="num_frecuency" />
                </div>

                <div class="">
                    @if ($num_frecuency == 1)
                        <select wire:model="frecuency" class="w-full rounded">
                            <option value="">{{ __('num veces por') }}</option>
                            <option value="minuto">minuto</option>
                            <option value="hora">hora</option>
                            <option value="dia">dia</option>
                            <option value="semana">semana</option>
                            <option value="mes">mes</option>
                            <option value="año">año</option>
                        </select>
                    @else
                        <select wire:model="frecuency" class="w-full rounded">
                            <option value="">{{ __('num veces por') }}</option>
                            <option value="minutos">minutos</option>
                            <option value="horas">horas</option>
                            <option value="dias">dias</option>
                            <option value="semanas">semanas</option>
                            <option value="meses">meses</option>
                            <option value="años">años</option>
                        </select>
                    @endif
                    <x-jet-input-error for="frecuency" />
                </div>

                <h1 class="col-span-1 md:col-span-2 text-center text-sm">{{ __('TIEMPO DE DURACIÓN') }}</h1>


                <div>
                    <select wire:model="num_duration" class="w-full rounded text-sm">
                        <option value="">{{ __('cantidad') }}</option>
                        @for ($k = 1; $k < 61; $k++)
                            <option value="{{ $k }}">por {{ $k }}</option>
                        @endfor
                    </select>
                    <x-jet-input-error for="num_duration" />
                </div>

                <div>
                    @if ($num_duration == 1)
                        <select wire:model="duration" class="w-full rounded text-sm">
                            <option value="">{{ __('cantidad por') }}</option>
                            <option value="dia">dia</option>
                            <option value="semana">semana</option>
                            <option value="mes">mes</option>
                            <option value="año">año</option>
                        </select>
                    @else
                        <select wire:model="duration" class="w-full rounded text-sm">
                            <option value="">{{ __('cantidad por') }}</option>
                            <option value="dias">dias</option>
                            <option value="semanas">semanas</option>
                            <option value="meses">meses</option>
                            <option value="años">años</option>
                        </select>
                    @endif
                    <x-jet-input-error for="duration" />
                </div>
                <div class="col-span-1 md:col-span-2">
                    <label for="instruction">{{ __('instructions') }}
                    </label>
                    <div class="bg-blue-500 p-1 text-white mb-1">
                        @if ($dose != '' &&
                            $dose_unit != '' &&
                            $frecuency != '' &&
                            $num_frecuency != '' &&
                            $duration != '' &&
                            $num_duration != '')
                            <p class="text-center text-xs">
                                {{ 'dar ' . $dose . ' ' . $dose_unit . ', cada ' . $num_frecuency . '  ' . $frecuency . ' por ' . $num_duration . ' ' . $duration }}                    </p>

                        @endif
                    </div>
                    <textarea class="w-full rounded" placeholder="{{ __('input instructions') }}" wire:model="instruction">


                    </textarea>
                    <x-jet-input-error for="instruction" />
                </div>


            </div>
        </x-slot>
        <x-slot name="footer">
            <button class="bg-yellow-500 text-white hover:bg-red-400 px-4 py-2 rounded" wire:click="resetKey">
                {{ __('cancel') }}
            </button>
            <button class="bg-green-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-6" type="submit"
                wire:click="modifyKey({{ $medicineId }})">
                {{ __('add') }}
            </button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
