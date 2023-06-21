<div class="container grid grid-cols-1 md:grid-cols-4">
    <div class="w-full col-span-4" id="datos-personales">
        <div class="card">
            <div class="card-body text-gray-500 flex justify-between items-center">
                <h1 class="font-bold text-2xl">{{ __('personal history') }}</h1>
                <button wire:click="abrir" class="text-red-800 hover:text-green-700 hover:transform hover:scale-150"
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
                                                <div class="font-semibold text-left">{{ __('antecedente') }}</div>
                                            </th>

                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">{{ __('observations') }}</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-center">{{ __('actiprons') }}</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">
                                        @forelse($patient_antecedents as $item)
                                            <tr>
                                                <td width="20%" class="p-2 whitespace-nowrap">
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
                                                            <div class="font-medium text-gray-800">
                                                                {{ $item->pivot->name }}
                                                            </div>
                                                            <div class="font-medium text-gray-800">
                                                                {{ __('year') . ': ' . $item->pivot->year }}</div>
                                                            <div class="font-medium text-gray-800">
                                                                {{ __('fecha') . ': ' . Carbon\Carbon::parse($item->pivot->date)->format('d-m-Y ')
                                                            }}</div>
                                                        </div>

                                                    </div>
                                                </td>

                                                <td width="60%" class="p-2 whitespace-wrap">
                                                    <div class="text-left font-medium text-grey-500">
                                                        <div class="text-left text-sm italic">
                                                            {{ $item->pivot->doctor }}:
                                                        </div>
                                                        {{ $item->pivot->observation }}
                                                    </div>
                                                </td>
                                                <td width="10%" class="p-2 whitespace-nowrap">
                                                    <div wire:click="edit({{ $item->pivot->id }})"
                                                        class="text-lg text-center cursor-pointer text-red-700 hover:text-green-600 mx-auto"
                                                        title="{{ __('edit patient disase') }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6 mx-auto">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                                        </svg>

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">
                                                    <h1 class="text-center text-gray-600 text-2xl">no hay antecedentes
                                                        personales
                                                        registrados</h1>
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
        <x-jet-dialog-modal wire:model="modal">
            <x-slot name="title">
                <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                    {{ __('add antecedent to patient history') }}
                </div>
                <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/especialidades.jpg') }}"
                    alt="">
            </x-slot>
            <x-slot name="content">
                <div class="flex gap-2 mb-3 text-sm">
                    <div class="w-1/2">
                        <select wire:model="antecedent_id" class="w-full rounded cursor-pointer"
                            title="nombre del antecedente">
                            <option value="">seleccione una antecedente</option>
                            @foreach ($antecedent_list as $item)
                                <option value="{{ $item->id }}" @if ($item->id == 89) selected @endif>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="antecedent_id" />
                    </div>


                    <div class="w-1/4">
                        <input class="w-full rounded cursor-pointer" type="number" placeholder="{{ __('year') }}"
                            wire:model="year" title="año del antecedente" />
                        <x-jet-input-error for="year" />
                    </div>

                    <div class="w-1/4">
                        <input class="w-full rounded cursor-pointer" type="date" placeholder="{{ __('date') }}"
                            wire:model="date" title="fecha del antecedente" />
                        <x-jet-input-error for="date" />
                    </div>

                </div>
                <div class="flex gap-2">
                    <div class="w-full">
                        <textarea class="w-full rounded cursor-pointer" placeholder="{{ __('observation') }}" wire:model="observation"
                            title="observaciones del antecedente" />
                </textarea>
                        <x-jet-input-error for="observation" />
                    </div>

                </div>
                <input type="hidden" wire:model="surgery_id">
            </x-slot>
            <x-slot name="footer">
                <button class="bg-red-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-3"
                    wire:click="$set('modal',false)">
                    {{ __('cancel') }}
                </button>
                <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3"
                    wire:click="addAntecedent">
                    {{ __('add antecedent') }}
                </button>

            </x-slot>
        </x-jet-dialog-modal>
    </section>

    <section>
        <x-jet-dialog-modal wire:model="modalEdit">
            <x-slot name="title">
                <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                    {{ __('add antecedent to patient history') }}
                </div>
                <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/especialidades.jpg') }}"
                    alt="">
            </x-slot>
            <x-slot name="content">
                <div class="flex gap-2 mb-3 text-sm">
                    <div class="w-1/2">
                        <select wire:model="antecedent_id" class="w-full rounded cursor-pointer"
                            title="nombre del antecedente">
                            <option value="">seleccione una antecedente</option>
                            @foreach ($antecedent_list as $item)
                                <option value="{{ $item->id }}" @if ($item->id == $antecedent_id) selected @endif>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="antecedent_id" />
                    </div>


                    <div class="w-1/4">
                        <input class="w-full rounded cursor-pointer" type="number" placeholder="{{ __('year') }}"
                            wire:model="year" title="año del antecedente" />
                        <x-jet-input-error for="year" />
                    </div>

                    <div class="w-1/4">
                        <input class="w-full rounded cursor-pointer" type="date" placeholder="{{ __('date') }}"
                            wire:model="date" title="fecha del antecedente" />
                        <x-jet-input-error for="date" />
                    </div>

                </div>
                <div class="flex gap-2">
                    <div class="w-full">
                        <textarea class="w-full rounded cursor-pointer" placeholder="{{ __('observation') }}" wire:model="observation"
                            title="observaciones del antecedente" />
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
                <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3"
                    wire:click="update">
                    {{ __('update') }}
                </button>

                <button class="bg-red-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3" wire:click="delete">
                    {{ __('delete antecedent') }}
                </button>

            </x-slot>
        </x-jet-dialog-modal>
    </section>


</div>
