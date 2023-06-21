
<div class="container grid grid-cols-1 md:grid-cols-4">
    <div class="w-full col-span-4" id="datos-de-enfermedades">
        <div class="card">
            <div class="card-body text-gray-500 flex justify-between items-center">
                <h1 class="font-bold text-2xl">{{ __('disases history') }}</h1>
                <button wire:click="$set('modal', 'true')" class="text-red-800 hover:text-green-700 hover:transform hover:scale-150" title="agregar enfermedad al paciente">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                                                <div class="font-semibold text-left">{{ __('disase') }}</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">{{ __('condition') }}</div>
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
                                        @forelse($patient_disases as $disase)
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
                                                                    src="{{ asset('img/profile.png') }}"
                                                                    width="40" height="40" alt="Alex Shatov">
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <div class="font-medium text-gray-800">{{ $disase->pivot->name }}
                                                            </div>
                                                            <div class="font-medium text-gray-800">
                                                                {{ __('year') . ': ' . $disase->pivot->year }}</div>
                                                        </div>

                                                    </div>
                                                </td>
                                                <td width="10%" class="p-2 whitespace-nowrap">
                                                    <div>
                                                        <div class="text-left">{{ $disase->pivot->condition }}</div>
                                                        <div class="text-left">
                                                            {{ $disase->pivot->inherited ? 'hereditaria' : '' }}</div>
                                                        <div class="text-left">
                                                            {{ $disase->pivot->deceased ? 'familiar fallecido' : '' }}
                                                        </div>
                                                    </div>

                                                </td>
                                                <td width="60%" class="p-2 whitespace-wrap">
                                                    <div class="text-left font-medium text-grey-500">
                                                        <div class="text-left text-sm italic">
                                                            {{ $disase->pivot->doctor }}:
                                                        </div>
                                                        {{ $disase->pivot->observation }}
                                                    </div>
                                                </td>
                                                <td width="10%" class="p-2 whitespace-nowrap">
                                                    <div wire:click = "edit({{ $disase->pivot->id }})" class="text-lg text-center cursor-pointer text-red-700 hover:text-green-600 mx-auto" title="{{ __('edit patient disase')}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                                          </svg>

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">
                                                    <h1 class="text-center text-gray-600 text-2xl">no hay enfermedad
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
    <x-dialog-modal-custom wire:model="modal" maxWidth="6xl">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('add disease to patient history') }}
            </div>
            <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/disases.jpg') }}" alt="">
        </x-slot>
        <x-slot name="content">
            <div class="w-full mb-2">

<div class=" pt-2 relative mx-auto text-gray-600 mb-2">
    <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
      type="search" wire:model="search" placeholder="Search">
      <button type="submit" class="absolute right-0 top-0 mt-2 btn btn btn-blue">
      buscar {{ $total }}
      </button>
      @if($search)
      <ul class="absolute left-0 w-full bg-white rounded text-xs scroll-my-1">
        @foreach ($disase_list as $item )
        <li class="leading-3 px-2 cursor-pointer hover:bg-red-500 my-3">{{ $item->name }}</li>
        @endforeach
      </ul>
      @endif
  </div>
            </div>
            <div class="flex gap-2">

                <div class="w-3/4">

                    {{-- <select wire:model="disase_id" class="select2 w-full rounded cursor-pointer">
                        <option value="">seleccione una enfermedad</option>
                        @foreach ($disase_list as $item )
                        <option value="{{ $item->id }}" @if($item->id==$patient_disase_id) selected @endif>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="disase_id" /> --}}
                </div>
                <div>
                    <input class="w-full rounded cursor-pointer" type="number" placeholder="{{ __('disase year') }}"
                        wire:model="year" />
                    <x-jet-input-error for="year" />
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
                    <x-jet-input-error for="inherited" />
                </div>

                <div class="w-1/3">
                    <div class="flex items-center mb-4">
                        <input wire:model="deceased" type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-checkbox"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('deceased') }}</label>
                    </div>
                    <x-jet-input-error for="deceased" />
                </div>

                <div class="w-1/3">

                    <select wire:model="condition" class="w-full rounded mb-4">
                        <option value="">Seleccione condición</option>
                        <option value="aguda">aguda</option>
                        <option value="crónica">crónica</option>
                    </select>
                    <x-jet-input-error for="condition" />
                </div>
            </div>
            <div class="w-full">
                <input class="w-full rounded cursor-pointer" type="text" placeholder="{{ __('observations') }}"
                    wire:model="observation" />
                <x-jet-input-error for="observation" />
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
    </x-dialog-modal-custom>
</section>

<section>
    <x-jet-dialog-modal wire:model="modalEdit">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('add disease to patient history') }}
            </div>
            <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/disases.jpg') }}" alt="">
        </x-slot>
        <x-slot name="content">
            <div class="flex gap-2">
                <div class="w-3/4 font-bold text-gray-500">
                    <h1 class="w-full mx-auto text-2xl text-center">{{ $name }}</h1>
                </div>
                <div>
                    <input class="w-full rounded cursor-pointer" type="number" placeholder="{{ __('disase year') }}"
                        wire:model="year" />
                    <x-jet-input-error for="year" />
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
                    <x-jet-input-error for="inherited" />
                </div>

                <div class="w-1/3">
                    <div class="flex items-center mb-4">
                        <input wire:model="deceased" type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-checkbox"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('deceased') }}</label>
                    </div>
                    <x-jet-input-error for="deceased" />
                </div>

                <div class="w-1/3">

                    <select wire:model="condition" class="w-full rounded mb-4">
                        <option value="">Seleccione condición</option>
                        <option value="aguda">aguda</option>
                        <option value="crónica">crónica</option>
                    </select>
                    <x-jet-input-error for="condition" />
                </div>
            </div>
            <div class="w-full">
                <input class="w-full rounded cursor-pointer" type="text" placeholder="{{ __('observations') }}"
                    wire:model="observation" />
                <x-jet-input-error for="observation" />
            </div>
            <input type="hidden" wire:model="disaseEditId">
        </x-slot>
        <x-slot name="footer">
            <button class="bg-yellow-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-3"
                wire:click="$set('modalEdit',false)">
                {{ __('cancel') }}
            </button>

            <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3" wire:click="update">
                {{ __('edit disase') }}
            </button>

            <button class="bg-red-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3" wire:click="delete">
                {{ __('delete disase') }}
            </button>


        </x-slot>
    </x-jet-dialog-modal>
</section>
@push('script')

@endpush
</div>
