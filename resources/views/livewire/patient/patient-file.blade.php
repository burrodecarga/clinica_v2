<div class="p-6 bg-gray-200">
    <h1 class="border rounded font-bold text-center py-2 uppercase text-gray-700 border text-sm bg-white">{{ __('Patients files') }}</h1>
    <button class="px-4 py-2 text-white w-full bg-blue-500 hover:bg-blue-700"
        wire:click="$set('openModal',true)">{{ __('add file') }}</button>
    <div>
        <ul class=" w-full bg-white">
            @foreach ($patient_files as $m)
                <li class="w-full border shadow px-4 py-2">
                    <a class="cursor-pointer px-4 py-2 text-gray-500"
                        wire:click="edit({{ $m->id }})">
                    <figure>
                        <h1 class="text-gray-800 font-bold text-sm">{{ $m->name }}</h1>
                        <hr>
                    @if($m->extension !== 'pdf')
                   <img src="{{ asset($m->url) }}" alt="{{ $m->name }}" class="h-28 w-28 object-cover mx-auto my-3">
                   @else

                   <a href="{{ asset($m->url) }}" target="blak">
                    <img src="{{ asset('assets/pdf.png') }}" alt="{{ $m->name }}" class="h-28 w-28 object-cover mx-auto my-3">
                    {{ __('see more...') }}
                   </a>
                   @endif
                   <hr>
                    <p>{{ $m->observation }}</p>
                    </figure>
                    </a>


                    <a wire:click="del({{ $m->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z" />
                        </svg>
                    </a>
                </li>
            @endforeach
        </ul>

    </div>

    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('add file') }}
            </div>
            <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/files.jpg') }}" alt="">
        </x-slot>
        <x-slot name="content">
            <div class="space-y-3">
                <input class="w-full" type="file" wire:model="file">
                <x-input-error for="file" />
                <div>
                    @if($file)
                    @if($file->extension() !== 'pdf')
                    <img src="{{ $file->temporaryURL() }}" alt="" class="h-20 w-20 object-cover">
                    @endif
                    @endif
                </div>

                <div>
                    <input wire:model="name" class="w-full rounded cursor-pointer" type="text"
                        placeholder="{{ __('input name') }}"></input>
                    <x-input-error for="observation" />
                </div>

                <div>
                    <textarea wire:model="observation" class="w-full rounded cursor-pointer" type="text"
                        placeholder="{{ __('input observation') }}"></textarea>
                    <x-input-error for="observation" />
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            <div class="flex items-center">
                <button class="bg-red-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-3"
                wire:click="$set('openModal',false)">
                {{ __('cancel') }}
            </button>
            <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3" wire:click="add" wire:loading.remove wire:target="file" >
                {{ __('add') }}
            </button>
            <div class="la-line-scale la-dark" wire:loading wire:target="file">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            </div>

           </x-slot>
    </x-dialog-modal>
    {{-- Do your work, then step back. --}}
</div>
