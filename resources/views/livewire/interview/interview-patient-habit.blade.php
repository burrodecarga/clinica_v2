<div class="container grid grid-cols-1 md:grid-cols-4">
    <div class="w-full col-span-4" id="datos-personales-habitos">
        <div class="card">
            <div class="card-body text-gray-500 flex justify-between items-center">
                <h1 class="font-bold text-2xl">{{ __('personal habits') }}</h1>
                <button wire:click="$set('modal',true)"
                    class="text-red-800 hover:text-green-700 hover:transform hover:scale-150"
                    title="agregar hábitos al paciente">
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
                                                <div class="font-semibold text-left">{{ __('habit') }}</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">{{ __('type') }}</div>
                                            </th>

                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">{{ __('observations') }}</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-center">{{ __('actions') }}</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">
                                        @forelse($patient_habits as $item)
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

                                                            <div class="font-bold font-medium text-gray-800">
                                                                {{ $item->pivot->name }}
                                                            </div>
                                                            <div class="font-medium text-gray-800">
                                                                {{ __('frecuency') . ': ' . $item->pivot->quantity }},{{ $item->pivot->frecuency }}
                                                            </div>
                                                            <div class="font-medium text-gray-800">
                                                                {{ __('severidad') . ': ' . $item->pivot->severity }}
                                                            </div>
                                                            <div class="font-medium text-gray-800">
                                                                {{ __('duración') . ': ' . $item->pivot->time }}. años.
                                                            </div>
                                                        </div>

                                                    </div>
                                                </td>
                                                <td width="10%" class="p-2 whitespace-wrap">
                                                    <div class="text-left font-medium text-grey-500">

                                                        {{ $item->pivot->type }}
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
                                                    <h1 class="p-4 text-center text-gray-600 text-2xl">no hay hábitos
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
                    {{ __('add habits to patient history') }}
                </div>
                <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/especialidades.jpg') }}"
                    alt="">
            </x-slot>
            <x-slot name="content">
                <div class="flex gap-2 mb-3 text-sm">
                    <div class="w-1/2">
                        <label for="habit_id">Tipo de Hábito</label>
                        <select wire:model="habit_id" class="w-full rounded cursor-pointer" title="nombre del hábito">
                            <option value="">seleccione un tipo</option>
                            @foreach ($habit_list as $item)
                                <option value="{{ $item->id }}" @if ($item->id == 89) selected @endif>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="habit_id" />
                    </div>



                    <div class="w-1/4">
                        <label for="habit_id">frecuencia</label>
                        <div>
                            <select wire:model="frecuency" class="w-full rounded" title="frecuencia del hábito">
                                <option value="">seleccione frecuenncia</option>
                                <option value="diario">{{ __('diario') }}</option>
                                <option value="semanal">{{ __('semanal') }}</option>
                                <option value="quincenal">{{ __('quincenal') }}</option>
                                <option value="mensual">{{ __('mensual') }}</option>
                                <option value="semestral">{{ __('semestral') }}</option>
                                <option value="anual">{{ __('anual') }}</option>
                            </select>
                            <x-jet-input-error for="frecuency" />
                        </div>
                        <x-jet-input-error for="frecuency" />
                    </div>

                    <div class="w-1/4">
                        <label for="habit_id">cantidad</label>
                        <input class="w-full rounded cursor-pointer" type="number"
                            placeholder="{{ __('quantity') }}" wire:model="quantity" title="cantidad del hábito" />
                        <x-jet-input-error for="quantity" />
                    </div>

                    <div class="w-1/4">
                        <label for="severity">severidad</label>
                        <div>
                            <select wire:model="severity" class="w-full rounded" title="severidad del hábito">
                                <option value="">seleccione severidad</option>
                                <option value="alta">{{ __('alta') }}</option>
                                <option value="media">{{ __('media') }}</option>
                                <option value="baja">{{ __('baja') }}</option>
                                <option value="nula">{{ __('nula') }}</option>
                            </select>
                            <x-jet-input-error for="severity" />
                        </div>
                        <x-jet-input-error for="severity" />
                    </div>


                </div>
                <div class="flex gap-2">
                    <div class="w-1/4">
                        <label for="time">años</label>
                        <input class="w-full rounded cursor-pointer" type="number"
                            placeholder="{{ __('time') }}" wire:model="time" title="años del hábito" />
                        <x-jet-input-error for="time" />
                    </div>
                    <div class="w-full">
                        <textarea class="w-full rounded cursor-pointer" placeholder="{{ __('observation') }}" wire:model="observation"
                            title="observaciones del hábito" />
                </textarea>
                        <x-jet-input-error for="observation" />
                    </div>

                </div>
                <input type="hidden" wire:model="habit_id">
            </x-slot>
            <x-slot name="footer">
                <button class="bg-red-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-3"
                    wire:click="$set('modal',false)">
                    {{ __('cancel') }}
                </button>
                <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3"
                    wire:click="addHabit">
                    {{ __('add habit') }}
                </button>

            </x-slot>
        </x-jet-dialog-modal>
    </section>


    <section>
        <x-jet-dialog-modal wire:model="modalEdit">
            <x-slot name="title">
                <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                    {{ __('edit habits to patient history') }}
                </div>
                <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/especialidades.jpg') }}"
                    alt="">
            </x-slot>
            <x-slot name="content">
                <div class="flex gap-2 mb-3 text-sm">
                    <div class="w-1/2">
                        <label for="habit_id">Tipo de Hábito</label>
                        <select wire:model="habit_id" class="w-full rounded cursor-pointer" title="nombre del hábito">
                            <option value="">seleccione un tipo</option>
                            @foreach ($habit_list as $item)
                                <option value="{{ $item->id }}" @if ($item->id == $habit_id) selected @endif>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="habit_id" />
                    </div>



                    <div class="w-1/4">
                        <label for="habit_id">frecuencia</label>
                        <div>
                            <select wire:model="frecuency" class="w-full rounded" title="frecuencia del hábito">
                                <option value="">seleccione frecuenncia</option>
                                <option @if($frecuency=='diario') selected @endif value="diario">{{ __('diario') }}</option>
                                <option @if($frecuency=='semanal') selected @endif value="semanal">{{ __('semanal') }}</option>
                                <option @if($frecuency=='quincenal') selected @endif value="quincenal">{{ __('quincenal') }}</option>
                                <option @if($frecuency=='mensual') selected @endif value="mensual">{{ __('mensual') }}</option>
                                <option @if($frecuency=='semestral') selected @endif value="semestral">{{ __('semestral') }}</option>
                                <option @if($frecuency=='anual') selected @endif value="anual">{{ __('anual') }}</option>
                            </select>
                            <x-jet-input-error for="frecuency" />
                        </div>
                        <x-jet-input-error for="frecuency" />
                    </div>

                    <div class="w-1/4">
                        <label for="habit_id">cantidad</label>
                        <input class="w-full rounded cursor-pointer" type="number"
                            placeholder="{{ __('quantity') }}" wire:model="quantity" title="cantidad del hábito" />
                        <x-jet-input-error for="quantity" />
                    </div>

                    <div class="w-1/4">
                        <label for="severity">severidad</label>
                        <div>
                            <select wire:model="severity" class="w-full rounded" title="severidad del hábito">
                                <option value="">seleccione severidad</option>
                                <option value="alta">{{ __('alta') }}</option>
                                <option value="media">{{ __('media') }}</option>
                                <option value="baja">{{ __('baja') }}</option>
                                <option value="nula">{{ __('nula') }}</option>
                            </select>
                            <x-jet-input-error for="severity" />
                        </div>
                        <x-jet-input-error for="severity" />
                    </div>


                </div>
                <div class="flex gap-2">
                    <div class="w-1/4">
                        <label for="time">años</label>
                        <input class="w-full rounded cursor-pointer" type="number"
                            placeholder="{{ __('time') }}" wire:model="time" title="años del hábito" />
                        <x-jet-input-error for="time" />
                    </div>
                    <div class="w-full">
                        <textarea class="w-full rounded cursor-pointer" placeholder="{{ __('observation') }}" wire:model="observation"
                            title="observaciones del hábito" />
                </textarea>
                        <x-jet-input-error for="observation" />
                    </div>

                </div>
                <input type="hidden" wire:model="habit_id">
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
                    {{ __('delete habit') }}
                </button>

            </x-slot>
        </x-jet-dialog-modal>
    </section>

</div>
