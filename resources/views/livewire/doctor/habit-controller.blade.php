<div class="my-4 bg-white ">
    <section class="w-full max-w-5xl mx-auto bg-white text-gray-600 h-screen px-4 py-8">
        <header class="px-5 py-4 border border-gray-100">
            <h2 class="font-bold text-center text-gray-800 capitalize text-2xl mb-2">{{ __('habits') }}</h2>
        </header>
        <div class="flex items-center bg-white p-3">
            <input class="w-full rounded" type="text" placeholder="{{ __('search habit') }}" wire:model="search" />
            <select class="mx-2 rounded" wire:model="perPage">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <select class="mx-2 rounded" wire:model="sortAsc">
                <option value="1">{{ __('asc') }}</option>
                <option value="0">{{ __('des') }}</option>
            </select>
            <a class="text-green-500 m-auto rounded cursor-pointer" wire:click="$set('modal',true)"
                title="agregar una nueva cirugía">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </a>
        </div>
        <table class="table-auto w-full bg-white p-6 border-separate border border-slate-400 ">
            <thead class="text-sm font-semibold uppercase text-white bg-gray-300">
                <tr>
                    <th>
                        <div class="p-4 text-left capitalize">{{ __('type') }}</div>
                    </th>
                    <th>
                        <div class="p-4 text-left capitalize">{{ __('habit') }}</div>
                    </th>
                    <th>
                        <div class="p-4 text-left capitalize">{{ __('description') }}</div>
                    </th>
                    <th>
                        <div class="p-4 text-left capitalize">{{ __('actions') }}</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($habits as $habit)
                    <tr>

                        <td class="p-2 whitespace-nowrap" width="10%">
                            <div class="flex items-center justify-start">
                                <div class="text-left">
                                    {{ $habit->type }}
                                </div>
                            </div>
                        </td>

                        <td class="p-2 whitespace-nowrap" width="20%">
                            <div class="flex items-center justify-start">
                                <div class="text-left">
                                    {{ $habit->name }}
                                </div>
                            </div>
                        </td>
                        <td class="p-2" width="55%">
                            <div class="flex items-center justify-start">
                                <div class="text-left">
                                    {{ $habit->description }}
                                </div>
                            </div>
                        </td>

                        <td class="p-2 whitespace-nowrap" width="15%">
                            <div class="flex justify-around items-center">
                                <a class="text-green-500 cursor-pointer" wire:click="edit({{ $habit->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <a class="text-red-500 cursor-pointer" wire:click="delete({{ $habit->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($habits->count() > 0)
        <div class="bg-white px-4 py-2 my-3">
            {{ $habits->links() }}
        </div>
        @endif

    </section>

   <x-dialog-modal wire:model="modal">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('add habit') }}
            </div>
            <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/banner-skill.jpg') }}"
                alt="{{ auth()->user()->name }}">
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <select wire:model="type" class="w-full rounded">
                        <option value="">{{ __('habits') }}</option>
                        <option value="alchólicos">{{ __('alchólicos') }}</option>
                        <option value="tabáquicos">{{ __('tabáquicos') }}</option>
                        <option value="adicciones">{{ __('adicciones') }}</option>
                        <option value="sexualidad">{{ __('sexualidad') }}</option>
                    </select>
                    <x-input-error for="type" />
                </div>
                <div class="col-span-1 md:col-span-3">
                    <input class="w-full rounded" type="text" placeholder="{{ __('habit') }}" wire:model="name" />
                    <x-input-error for="name" />
                </div>

                <div class="col-span-1 md:col-span-3">
                    <div>
                        <textarea class="w-full rounded" type="textarea" placeholder="{{ __('description') }}" wire:model="description" /></textarea>
                        <x-input-error for="description" />
                    </div>
                </div>
            </div>


        </x-slot>
        <x-slot name="footer">
            <button class="bg-red-500 text-white hover:bg-red-900 px-4 py-2 rounded mx-3"
                wire:click="$set('modal',false)">
                {{ __('cancel') }}
            </button>
            <button class="bg-green-500 text-white hover:bg-green-800 px-4 py-2 rounded" type="submit"
                wire:click="addHabit">
                {{ __('create') }}
            </button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="modalEdit">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('add habit') }}
            </div>
            <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/banner-skill.jpg') }}"
                alt="{{ auth()->user()->name }}">
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <select wire:model="type" class="w-full rounded">
                        <option value="">{{ __('habits') }}</option>
                        <option value="alchólicos" @if($type=='alchólicos') selected @endif>{{ __('alchólicos') }}</option>
                        <option value="tabáquicos" @if($type=='tabáquicos') selected @endif>{{ __('tabáquicos') }}</option>
                        <option value="adicciones" @if($type=='adicciones') selected @endif>{{ __('adicciones') }}</option>
                        <option value="sexualidad" @if($type=='sexualidad') selected @endif>{{ __('sexualidad') }}</option>
                    </select>
                    <x-input-error for="type" />
                </div>
                <div class="col-span-1 md:col-span-3">
                    <input class="w-full rounded" type="text" placeholder="{{ __('habit') }}" wire:model="name" />
                    <x-input-error for="name" />
                </div>

                <div class="col-span-1 md:col-span-3">
                    <div>
                        <textarea class="w-full rounded" type="textarea" placeholder="{{ __('description') }}" wire:model="description" /></textarea>
                        <x-input-error for="description" />
                    </div>
                </div>
            </div>


        </x-slot>
        <x-slot name="footer">
            <button class="bg-red-500 text-white hover:bg-red-900 px-4 py-2 rounded mx-3"
                wire:click="$set('modalEdit',false)">
                {{ __('cancel') }}
            </button>
            <button class="bg-green-500 text-white hover:bg-green-800 px-4 py-2 rounded" type="submit"
                wire:click="update">
                {{ __('create') }}
            </button>
        </x-slot>
    </x-dialog-modal>


</div>
