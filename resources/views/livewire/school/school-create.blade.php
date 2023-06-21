<section class="w-full">
    <div>
        <button class="w-full bg-green-500 text-white hover:bg-green-400 px-4 py-2" wire:click="$set('openModal',true)">
            {{ __('add school') }}
        </button>
    </div>
    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('add school') }}

            </div>
            <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/libro.jpg') }}"
                alt="{{ auth()->user()->name }}">
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="seleccionadas">
                    <div>
                        <input class="w-full rounded" type="text" placeholder="{{ __('title') }}" wire:model="title"/>
                        <x-jet-input-error for="title"/>
                    </div>
                </div>

                <div class="seleccionadas">
                    <div>
                        <input class="w-full rounded" type="text" placeholder="{{ __('specialty') }}" wire:model="specialty"/>
                        <x-jet-input-error for="specialty"/>
                    </div>
                </div>

                <div class="seleccionadas">
                    <div>
                        <input class="w-full rounded" type="text" placeholder="{{ __('university') }}" wire:model="university"/>
                        <x-jet-input-error for="university"/>
                    </div>
                </div>

                <div class="seleccionadas">
                    <div>
                        <input class="w-full rounded" type="text" placeholder="{{ __('year') }}" wire:model="year"/>
                        <x-jet-input-error for="year"/>
                    </div>
                </div>

                <div class="seleccionadas">
                    <div>
                        <input class="w-full rounded" type="text" placeholder="{{ __('college') }}" wire:model="college"/>
                        <x-jet-input-error for="college"/>
                    </div>
                </div>

                <div class="seleccionadas">
                    <div>
                        <input class="w-full rounded" type="text" placeholder="{{ __('number') }}" wire:model="number"/>
                        <x-jet-input-error for="number"/>
                    </div>
                </div>


            </div>
        </x-slot>
        <x-slot name="footer">
            <button class="bg-red-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-3"
                wire:click="$set('openModal',false)">
                {{ __('cancel') }}
            </button>
            <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded"
           type="submit" wire:click="addSchool">
                {{ __('create') }}
            </button>
        </x-slot>
    </x-jet-dialog-modal>
</section>
