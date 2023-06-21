<section>
    <div class="mx-10 my-2">
        <button class="rounded w-full bg-green-500 text-white hover:bg-green-400 px-4 py-2" wire:click="$set('openModal',true)">
            {{ __('add skill') }}
        </button>
    </div>
    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('add skill') }}
            </div>
            <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/banner-skill.jpg') }}"
                alt="{{ auth()->user()->name }}">
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 gap-6">
                <div class="aseleccionar">
                    <select class="w-full rounded" wire:model="specialty">
                        <option value="">{{__('select specialty') }}</option>
                        @foreach ($specialties as $s)
                            <option value="{{ $s->name }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="specialty"/>
                </div>
                <div class="seleccionadas">
                    <div>
                        <input class="w-full rounded" type="text" placeholder="{{ __('title') }}" wire:model="title"/>
                        <x-input-error for="title"/>
                    </div>
                </div>

                <div class="seleccionadas">
                    <div>
                        <textarea class="w-full rounded" type="textarea" placeholder="{{ __('description') }}" wire:model="description" /></textarea>
                        <x-input-error for="description"/>
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
           type="submit" wire:click="addSkill">
                {{ __('create') }}
            </button>
        </x-slot>
    </x-dialog-modal>
</section>
