<section>
    <div class="mx-20 my-2">
        <button class="rounded w-full bg-green-500 text-white hover:bg-green-400 px-4 py-2" wire:click="$set('openModal',true)">
            {{ __('add social') }}
        </button>
    </div>
    <x-dialog-modal wire:model="openModal" wire:submit.prevent="addSocial">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('add specialty') }}
            </div>
            <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/banner-social.jpg') }}"
                alt="{{ auth()->user()->name }}">
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 gap-6">
                <div class="w-full bg-blue-400 p-2 border-2 border-white text-white font-medium uppercase">{{ __('social media') }}</div>
                <div class="w-full bg-blue-400 p-2 border-2 border-white text-white font-medium uppercase">{{ __('socials').' : '. auth()->user()->name }}</div>
                <div class="aseleccionar">
                    <select class="w-full rounded" wire:model="social_id">
                        <option value="">{{__('select media social') }}</option>
                        @foreach ($socials as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="seleccionadas">
                    <div>
                        <input class="w-full rounded" type="text" placeholder="{{ __('url') }}" wire:model="url"/>
                        <x-input-error for="url"/>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button class="mx-6 bg-red-500 text-white hover:bg-red-400 px-4 py-2 rounded"
                wire:click="$set('openModal',false)">
                {{ __('cancel') }}
            </button>
            <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded"
           type="submit" wire:click="addSocial">
                {{ __('ok') }}
            </button>
        </x-slot>
    </x-dialog-modal>
</section>
