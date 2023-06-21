<div>
    <div class="py-8">
        <section class="w-full max-w-5xl mx-auto bg-gray-100 text-gray-600 h-screen px-4 py-8">
            <header class="px-5 py-4 border-b border-gray-100">
                <h2 class="font-bold text-center text-gray-800 capitalize text-2xl mb-2">{{ __('document verify') }}</h2>
            </header>
            <div class="flex items-center bg-white p-3">
                <input class="w-full rounded" type="text" placeholder="search doctor" wire:model="search"/>
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
                {{-- <a class="text-green-500 m-auto rounded cursor-pointer" wire:click="$set('modal',true)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </a> --}}
            </div>
            <table class="table-auto w-full bg-white p-6">
                <thead class="text-sm font-semibold uppercase text-white bg-gray-300">
                    <tr>
                        <th>
                            <div class="p-4 text-left capitalize">{{ __('state') }}</div>
                        </th>
                        <th>
                            <div class="p-4 text-left capitalize">{{ __('name') }}</div>
                        </th>
                        <th>
                            <div class="p-4 text-left capitalize">{{ __('document') }}</div>
                        </th>
                        <th>
                            <div class="p-4 text-left capitalize">{{ __('verify by') }}</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents as $document)
                        <tr>
                            <td class="p-2">
                                <div class="mx-auto">
                                    <span>
                                    @if($document->verify)

                                    <svg wire:click="desmarcar({{ $document->id }})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer text-green-700 hover:text-red-700 mx-auto">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                      </svg>
                                      @else
                                      <svg wire:click="marcar({{ $document->id }})" xmlns="http://www.w3.org/2000/svsvg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer text-red-700 hover:text-green-700 mx-auto">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                      </svg>
                                      @endif
                                    </span>
                                 </div>

                            </td>
                            <td class="p-2" width="20%">
                                <div>
                                    {{ $document->name }}
                                </div>
                            </td>

                            <td class="p-2 cursor-pointer" width="30%">
                                @if ($document->file_extension != 'pdf')
                                <div wire:click="ver({{ $document->id }})">
                                   <img src="{{ Storage::url($document->file_path) }}" alt="" class="h-16 mx-auto">
                                </div>
                                @else
                                <div class="bg-red-300">
                                    <a href="{{ Storage::url($document->file_path) }}" target="_blank"
                                        class=" bg-gray-400 text-black w-32 h-32 rounded"><img src="{{ asset('assets/pdf.jpg') }}"
                                            alt="pdf icon"></a>

                                </div>
                                @endif
                            </td>

                            <td class="p-2" width="40%">
                                <div>
                                    <span class="text-sm text-gray-500">{{ $document->verify_by }}</span>
                                    <span class="text-xs text-gray-400 italic"> {{ $document->verify_at }}</span>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
                {{-- @if ($disases->count() > 0)
           <div class="flex justify-between text-xs my-3 bg-gray-400 p-4">
               {{ $disases->links('vendor.livewire.simple-tailwind') }}
           </div>       @endif --}}

        </section>

<x-dialog-modal wire:model="modal">
            <x-slot name="title">
                <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                    {{ __('add dissase') }}
                </div>
                <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/banner-skill.jpg') }}"
                    alt="{{ auth()->user()->name }}">
            </x-slot>
            <x-slot name="content">
                <div class="">
                    <img src="{{ Storage::url($url) }}" alt="" class="h-64 mx-auto">
                </div>
            </x-slot>
            <x-slot name="footer">
                <button class="bg-red-500 text-white hover:bg-red-900 px-4 py-2 rounded mx-3"
                    wire:click="$set('modal',false)">
                    {{ __('cancel') }}
                </button>
            </x-slot>
        </x-dialog-modal>
    </div>

</div>
