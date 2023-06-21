<div class="container grid grid-cols-1 md:grid-cols-4">
    <div class="w-full col-span-4" id="datos-de-alergias">
        <div class="card">
            <div class="card-body text-gray-500 flex justify-between items-center">
                <h1 class="font-bold text-2xl">{{ __('vaccines history') }}</h1>
                <div class="justify-between">
                <button wire:click="$set('modalVaccine', 'true')"
                class="text-red-800 hover:text-green-700 hover:transform hover:scale-150 mr-8"
                title="agregar nueva vacuna">
                <i class="fa-solid fa-syringe icono"></i>
            </button>

                <button wire:click="$set('modal', 'true')"
                    class="text-red-800 hover:text-green-700 hover:transform hover:scale-150"
                    title="agregar vacunas al paciente">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
                </div>
            </div>

            <!-- component -->
            <section class="antialiased bg-gray-100 text-gray-600">
                <div class="flex flex-col justify-center h-full">
                    <!-- Table -->
                    <div class="w-full max-w-7xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                        <header class="px-5 py-4 border-b border-gray-100">

                        </header>
                        <div class="p-3">
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full">
                                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                        <tr>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">{{ __('vaccine') }}</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-center">{{ __('date') }}</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">
                                        @forelse($userVaccines as $item)
                                            <tr>
                                                <td width="70%" class="p-2 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        @if ($user->profile_photo_path)
                                                            <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img
                                                                    class="rounded-full"
                                                                    src="{{ Storage::url($user->profile_photo_path) }}"
                                                                    width="40" height="40" alt="Alex Shatov">
                                                            </div>
                                                        @else
                                                            <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img
                                                                    class="rounded-full"
                                                                    src="{{ asset('img/profile.png') }}" width="40"
                                                                    height="40" alt="Alex Shatov">
                                                            </div>
                                                        @endif
                                                        <div class="flex items-center">
                                                            <button wire:click="delete({{ $item->id }})" class="cursor-pointer"
                                                                title="{{ 'eliminar ' . $item->name . ' a paciente' }}">

                                                                <i class="fa-solid fa-syringe text-red-500"></i>
                                                            </button>
                                                            <span
                                                                class="font-medium text-gray-800 mx-3">
                                                                <div>
                                                                    {{ $item->name . '  ' }}
                                                                </div>
                                                                @if($item->pivot)
                                                                <div>

                                                                    {{  \Carbon\Carbon::parse($item->pivot->date)->format('d/m/Y') }}
                                                                </div>
                                                                @endif
                                                            </span>
                                                            @if($item->pai)
                                                            <i class="fa-solid fa-person-breastfeeding icono" title="Vacuna tipo PAI"></i>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </td>

                                                <td width="30%" class="p-2 whitespace-nowrap">
                                                    <div                                             class="flex gap-2 items-center text-lg text-center cursor-pointer text-red-700 hover:text-green-600 mx-auto"
                                                        title="{{ __('Modificar Fecha de vacunación') }}">

                                                        <small>

                                                        <input wire:model='date'wire:change="bdc({{ $item }})" type="date" class="rounded text-xs" required value="{{  \Carbon\Carbon::parse($item->pivot->date)->format('Y-m-d') }}"> </small>

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">
                                                    <h1 class="text-center text-gray-600 text-2xl">no hay vacunas
                                                        registrada</h1>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <section>
        <x-dialog-modal-custom wire:model="modal" wire:submit.self="save" maxWidth="3xl">
            <x-slot name="title">
                <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                    {{ __('patient vaccination') }}

                </div>
                <img class="h-24 w-full object-center object-cover" src="{{ asset('assets/banner-medical.jpg') }}"
                    alt="{{ auth()->user()->name }}">
            </x-slot>
            <x-slot name="content">
                <div>
                    @if (session()->has('message'))
                        <div id="alert" class="alerta">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="buscador col-span-2 mb-1">
                        <input class=" w-full rounded" placeholder="{{ __('find vaccine') }}" type="text"
                            wire:model="search">
                    </div>
                    <div class="w-full bg-blue-400 p-2 border-2 border-white text-gray-800 mb-2">{{ __('vaccines list') }}</div>
                    <div class="w-full bg-blue-400 p-2 border-2 border-white text-gray-800 mb-2">
                        {{ __('register vaccines') }}</div>
                    <div class="aseleccionar">
                        @forelse ($vaccines as $s)
                            <div class="w-full border mb-1 px-3">
                                <button wire:click="modify({{ $s->id }})" class="cursor-pointer"
                                    title="{{ 'agregar ' . $s->name . ' a paciente' }}">

                                    <i class="fa-solid fa-syringe text-red-500"></i>
                                    <span
                                        class="text-gray-500">
                                        {{ $s->name . '  ' }}
                                    </span>
                                    </button>
                                    @if($s->pai)
                                        <span class="pai">Tipo: PAI</span>
                                         @endif
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
                        @forelse($userVaccines as $d)
                            <div class="border mb-1 px-2">
                                <button wire:click="delete({{ $d->id }})" class="cursor-pointer">
                                    <i class="fa-solid fa-trash-can text-red-600 mx-2" title="{{ 'eliminar ' . $d['name'] . ' a paciente' }}"></i>
                                </button>
                                    <span
                                        class="ml-4 text-gray-500 italic">{{ $d['name'] }}</span>
                                        @if($d['pai'])
                                        <span class="pai">Tipo: PAI</span>
                                         @endif


                            </div>

                        @empty
                            <div class="border mb-1">
                                <a class="cursor-pointer">
                                    <span class="ml-4 font-bold">No hay registro de vacunas</span> </a>
                            </div>
                        @endforelse

                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <button class="bg-yellow-700 text-white hover:bg-red-400 px-4 py-2 rounded"
                    wire:click="$set('modal',false)">
                    {{ __('close') }}
                </button>

            </x-slot>
        </x-dialog-modal-custom>
    </section>

    <section>
        <x-dialog-modal-custom wire:model="modalVaccine" wire:submit.self="saveVaccine" maxWidth="2xl">
            <x-slot name="title">
                <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                    {{ __('new vaccine') }}

                </div>
                <img class="h-24 w-full object-center object-cover" src="{{ asset('assets/banner-medical.jpg') }}"
                    alt="{{ auth()->user()->name }}">
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-5 gap-4 items-center">
                    <div class="col-span-4">
                        <input class="w-full rounded cursor-pointer" type="text" placeholder="{{ __('name of vaccine') }}"
                            wire:model="name" />
                        <x-input-error for="name" />
                    </div>
                    <div class="col-span-1">
                        <div class="flex items-center">
                            <input wire:model="pai" id="default-checkbox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">PAI</label>
                        </div>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <button class="bg-yellow-700 text-white hover:bg-red-400 px-4 py-2 rounded"
                    wire:click="$set('modalVaccine',false)">
                    {{ __('close') }}
                </button>

                <button class="bg-green-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-6" type="submit"
                wire:click="saveVaccine">
                {{ __('create') }}
            </button>
            </x-slot>
        </x-dialog-modal-custom>
    </section>


</div>
