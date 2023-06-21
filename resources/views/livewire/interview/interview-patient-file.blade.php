<div class="p-6 bg-white">
    <h1 class="border rounded font-bold text-center py-2 uppercase text-gray-700 border text-sm bg-white">
        {{ __('patients files  : ') . $patient_files->count() }}</h1>
    <h1 class="text-center text-gray-600 text-xs bg-white">{{ __('Archivos registrados  : ') . $patient_files->count() }}
    </h1>
    <button class="px-4 py-2 text-white w-full bg-blue-500 hover:bg-blue-700 my-3 rounded"
        wire:click="$set('openModal',true)">{{ __('add file') }}</button>
    <div>
        <ul class=" w-full bg-white grid grid-cols-3 gap-2">
            @foreach ($patient_files as $m)
                {{-- componentr --}}
                <div class="max-w-sm rounded overflow-hidden shadow-lg">

                    <figure class="">

                        @if ($m->extension !== 'pdf')
                            <img src="{{ asset($m->url) }}" alt="{{ $m->name }}" class="object-cover mx-auto my-3">
                        @else
                            <img src="{{ asset('assets/pdf1.png') }}" alt="{{ $m->name }}"
                                class="object-cover mx-auto my-3" />
                        @endif
                    </figure>

                    <div class="px-6 py-4 my-3">
                        <div class="font-bold text-xl">{{ Str::limit($m->name, 35) }}
                        </div>
                        <div class="mb-2">
                            <small>
                                {{ $m->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <p class="text-gray-700 text-base">
                            {{ Str::limit($m->observation, 150) }}
                        </p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <span
                            class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                            <a href="{{ route('interviews.ficha', $m->id) }}" target="blak">ficha</a></span>
                        <span
                            class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                            <a href="{{ asset($m->url) }}" target="blak">archivo</a></span>
                        <span
                            class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                            <a wire:click="del({{ $m->id }})" class="cursor-pointer">
                                eliminar
                            </a>
                        </span>
                    </div>
                </div>
                {{-- fin componente --}}
            @endforeach
        </ul>

    </div>

    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('add file') }}
            </div>
            <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/files.jpg') }}" alt="">
        </x-slot>
        <x-slot name="content">
            <div class="space-y-3">
                <input class="w-full" type="file" wire:model="file">
                <x-jet-input-error for="file" />
                <div>
                    @if ($file)
                        @if ($file->extension() !== 'pdf')
                            <img src="{{ $file->temporaryURL() }}" alt="" class="h-20 w-20 object-cover" />
                        @else
                            <img src="{{ asset('assets/pdf1.png') }}" alt="" class="h-20 w-20 object-cover" />
                        @endif
                    @endif
                </div>

                <div>
                    <input wire:model="name" class="w-full rounded cursor-pointer" type="text"
                        placeholder="{{ __('input name') }}"></input>
                    <x-jet-input-error for="name" />
                </div>

                <div>
                    <textarea wire:model="observation" class="w-full rounded cursor-pointer" type="text"
                        placeholder="{{ __('input observation') }}"></textarea>
                    <x-jet-input-error for="observation" />
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            <div class="flex items-center">
                <button class="bg-red-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-3"
                    wire:click="$set('openModal',false)">
                    {{ __('cancel') }}
                </button>
                <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3" wire:click="add"
                    wire:loading.remove wire:target="file">
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
    </x-jet-dialog-modal>
    {{-- Do your work, then step back. --}}
</div>
