<div class="container grid grid-cols-1 md:grid-cols-4">
    <div class="w-full col-span-4" id="datos-de-alergias">
        <div class="card">
            <div class="card-body text-gray-500 flex justify-between items-center">
                <h1 class="font-bold text-2xl">{{ __('allergy history') }}</h1>
                <button wire:click="$set('modal', 'true')"
                    class="text-red-800 hover:text-green-700 hover:transform hover:scale-150"
                    title="agregar cirugía al paciente">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                </button>
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
                                                <div class="font-semibold text-left">{{ __('allergy') }}</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">
                                        @forelse($userAllergies as $item)
                                            <tr>
                                                <td width="100%" class="p-2 whitespace-nowrap">
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
                                                        <div>
                                                            <button wire:click="delete({{ $item->id }})" class="cursor-pointer"
                                                                title="{{ 'eliminar ' . $item->name . ' a paciente' }}">

                                                                <i class="fa-solid fa-virus-slash text-red-500"></i>
                                                                <span
                                                                    class="font-medium text-gray-800">
                                                                    {{ $item->name . '  ' }}</span>
                                                            </button>
                                                        </div>

                                                    </div>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">
                                                    <h1 class="text-center text-gray-600 text-2xl">no hay alergias
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
        <x-dialog-modal-custom wire:model="modal" wire:submit.self="save" maxWidth="6xl">
            <x-slot name="title">
                <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                    {{ __('allergies') }}

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
                    <div class="w-full bg-blue-400 p-2 border-2 border-white text-gray-800 mb-2">{{ __('allergies list') }}</div>
                    <div class="w-full bg-blue-400 p-2 border-2 border-white text-gray-800 mb-2">
                        {{ __('register allergies') }}</div>
                    <div class="aseleccionar">
                        @forelse ($allergies as $s)
                            <div class="w-full border mb-1 px-3">
                                <button wire:click="modify({{ $s->id }})" class="cursor-pointer"
                                    title="{{ 'agregar ' . $s->name . ' a paciente' }}">
                                    <i class="fa-solid fa-tachograph-digital text-green-500"></i>
                                    <span
                                        class="text-gray-500">
                                        {{ $s->name . '  ' }}</span>
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

                        @forelse($userAllergies as $d)
                            <div class="border mb-1 px-2">
                                <button wire:click="delete({{ $d->id }})" class="cursor-pointer">
                                    <i class="fa-solid fa-trash-can text-red-600 mx-2" title="{{ 'eliminar ' . $d['name'] . ' a paciente' }}"></i>
                                </button>
                                    <span
                                        class="ml-4 text-gray-500 italic">{{ $d['name'] }}</span>

                            </div>

                        @empty
                            <div class="border mb-1">
                                <a class="cursor-pointer">
                                    <span class="ml-4 font-bold">No hay registro de alergias</span> </a>
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

    {{-- <section>
        <x-jet-dialog-modal wire:model="modalEdit">
            <x-slot name="title">
                <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                    {{ __('edit surgery to patient history') }}
                </div>
                <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/especialidades.jpg') }}"
                    alt="">
            </x-slot>
            <x-slot name="content">
                <div class="flex gap-2 mb-3 text-sm">
                    <div class="w-1/2">
                        <select wire:model="surgery_id" class="w-full rounded cursor-pointer">
                            <option value="">seleccione una cirugía</option>
                            @foreach ($surgeries_list as $item)
                                <option value="{{ $item->id }}" @if ($item->id == $surgeryEditId) selected @endif>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="surgery_id" />
                    </div>

                    <div class="w-1/4">
                        <select wire:model="type" class="w-full rounded cursor-pointer">
                            <option value="">cirugía tipo</option>
                            <option value="cirugía mayor">cirugía mayor</option>
                            <option value="cirugía menor">cirugía menor</option>
                            <option value="cirugía de emergencia">cirugía de emergencia</option>
                            <option value="cirugía electiva">cirugía electiva</option>
                            <option value="otra">otra</option>
                        </select>
                        <x-jet-input-error for="type" />
                    </div>

                    <div class="w-1/4">
                        <input class="w-full rounded cursor-pointer" type="number"
                            placeholder="{{ __('year') }}" wire:model="year" />
                        <x-jet-input-error for="year" />
                    </div>
                </div>
                <div class="flex gap-2">
                    <div class="w-full">
                        <textarea class="w-full rounded cursor-pointer" placeholder="{{ __('observation') }}" wire:model="observation" />
            </textarea>
                        <x-jet-input-error for="observation" />
                    </div>

                </div>
                <input type="hidden" wire:model="surgery_id">
            </x-slot>
            <x-slot name="footer">
                <button class="bg-red-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-3"
                    wire:click="$set('modalEdit',false)">
                    {{ __('cancel') }}
                </button>
                <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3" wire:click="update">
                    {{ __('edit surgery') }}
                </button>

                <button class="bg-red-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3" wire:click="delete">
                    {{ __('delete surgery') }}
                </button>

            </x-slot>
        </x-jet-dialog-modal>
    </section> --}}


</div>
