<div class="container grid grid-cols-1 md:grid-cols-4">
    <div class="w-full col-span-4" id="hijos">
        <div class="card">
            <div class="card-body text-gray-500 flex justify-between items-center">
                <h1 class="font-bold text-2xl">{{ __('sons') }}</h1>
                <button wire:click="$set('modal',true)"
                    class="text-red-800 hover:text-green-700 hover:transform hover:scale-150"
                    title="agregar hijos al paciente">
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
                                                <div class="font-semibold text-left">{{ __('name') }}</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap" colspan="2">
                                                <div class="font-semibold text-center">{{ __('actions') }}</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">
                                        @forelse($sons as $item)
                                            <tr>

                                                <td width="80%" class="p-2 whitespace-nowrap">
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
                                                                {{ $item->name }}
                                                            </div>
                                                            <div class="font-medium text-gray-800">
                                                                {{ __('edad') . ': ' .  $item->edad() }}
                                                            </div>
                                                            <div class="font-medium text-gray-800">
                                                                {{ __('sexo') . ': ' . $item->gender }}
                                                            </div>
                                                        </div>

                                                    </div>
                                                </td>
                                                <td width="10%" class="p-2 whitespace-nowrap text-center">
                                                    <a href="{{ route('interviews.create',$item->id) }}"
                                                        class="text-lg text-center cursor-pointer text-red-700 hover:text-green-600"
                                                        title="{{ 'entrevistar a '.$item->name }}">

                                                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                                                          </svg>



                                                    </a>
                                                </td>
                                                <td width="10%" class="p-2 whitespace-nowrap text-center">
                                                    <a
                                                        class="text-lg text-center cursor-pointer text-red-700 hover:text-green-600"
                                                        title="{{ 'editar a  '.$item->name }}" wire:click="edit({{ $item->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-journal-medical h-6 w-6 mx-auto text-green-600" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v.634l.549-.317a.5.5 0 1 1 .5.866L9 6l.549.317a.5.5 0 1 1-.5.866L8.5 6.866V7.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L7 6l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V4.5A.5.5 0 0 1 8 4zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                                            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                                                          </svg>  </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">
                                                    <h1 class="p-4 text-center text-gray-600 text-2xl">no tiene hijos
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
                    {{ __('add sons to patient history') }}
                </div>
                <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/especialidades.jpg') }}"
                    alt="">
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-4 gap-2">
                    <div class="mb-4 col-span-2">
                        <label for="name">{{ __('name') }}</label>
                        <input class="w-full rounded cursor-pointer mt-1" type="text"
                            placeholder="{{ __('name') }}" wire:model="name" title="{{ __('name') }}" />
                        <x-jet-input-error for="name" />
                    </div>
                    <div class="mb-4 col-span-1">
                        <label for="birthdate" class="block">fecha de nacimiento</label>
                        <input wire:model="birthdate" type="date" class="w-full mt-1 rounded-lg"
                            value="{{ old('birthdate', $birthdate) }}">
                        <x-jet-input-error for="birthdate" />
                    </div>
                    <div class="mb-4 col-span-1">
                        <label for="gender" class="block">sexo</label>
                        <select wire:model="gender" class="w-full mt-1 rounded-lg">
                            <option value="femenino">femenino</option>
                            <option value="masculino">masculino</option>
                        </select>
                        <x-jet-input-error for="gender" />
                    </div>


                <input type="hidden" wire:model="user_id">
            </x-slot>
            <x-slot name="footer">
                <button class="bg-red-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-3"
                    wire:click="$set('modal',false)">
                    {{ __('cancel') }}
                </button>
                <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3"
                    wire:click="addSon">
                    {{ __('add son') }}
                </button>

            </x-slot>
        </x-jet-dialog-modal>
    </section>

    <section>
        <x-jet-dialog-modal wire:model="modalEdit">
            <x-slot name="title">
                <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                    {{ __('add sons to patient history') }}
                </div>
                <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/especialidades.jpg') }}"
                    alt="">
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-4 gap-2">
                    <div class="mb-4 col-span-2">
                        <label for="name">{{ __('name') }}</label>
                        <input class="w-full rounded cursor-pointer mt-1" type="text"
                            placeholder="{{ __('name') }}" wire:model="name" title="{{ __('name') }}" />
                        <x-jet-input-error for="name" />
                    </div>
                    <div class="mb-4 col-span-1">
                        <label for="birthdate" class="block">fecha de nacimiento</label>
                        <input wire:model="birthdate" type="date" class="w-full mt-1 rounded-lg"
                            value="{{ old('birthdate', $birthdate) }}">
                        <x-jet-input-error for="birthdate" />
                    </div>
                    <div class="mb-4 col-span-1">
                        <label for="gender" class="block">sexo</label>
                        <select wire:model="gender" class="w-full mt-1 rounded-lg">
                            <option value="femenino">femenino</option>
                            <option value="masculino">masculino</option>
                        </select>
                        <x-jet-input-error for="gender" />
                    </div>


                <input type="hidden" wire:model="userId">
            </x-slot>
            <x-slot name="footer">
                <button class="bg-red-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-3"
                    wire:click="$set('modalEdit',false)">
                    {{ __('cancel') }}
                </button>
                <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3"
                    wire:click="update({{ $userId }})">
                    {{ __('update') }}
                </button>
                <button class="bg-red-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3" wire:click="delete({{ $userId }})">
                    {{ __('delete') }}
                </button>
            </x-slot>
        </x-jet-dialog-modal>
    </section>
</div>
