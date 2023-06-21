<section class="text-gray-700 rounded">
    <ul class="w-full justify-start">
        @foreach ($schools as $school)
            <!-- component -->
            <div class="bg-blue w-full p-8 flex justify-center font-sans">
                <div class="rounded bg-grey-light w-full p-2">
                    <div class="flex justify-between py-1">
                        <h3 class="font-bold">
                            <span class="text-sm">{{ $school->title }}</span>
                            <span class="text-gray-300 mx-4">|</span>
                            <span class="text-sm italic">{{ $school->specialty }}</span>
                        </h3>
                        <svg class="h-4 fill-current text-grey-dark cursor-pointer" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M5 10a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4zm7 0a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4zm7 0a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4z" />
                        </svg>
                    </div>
                    <div class="text-sm mt-2">
                        <div
                            class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                            <span class="text-gray-400 mx-1">{{ $school->university }}</span>
                            <span class="text-gray-300 mx-4">|</span>
                            <span class="text-gray-400 mx-1">{{ $school->year }}</span>
                        </div>
                        <div
                            class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                            <span class="text-gray-400 mx-1">{{ $school->college }}</span>
                            <span class="text-gray-300 mx-4">|</span>
                            <span class="text-gray-400 mx-1">{{ $school->number }}</span>
                        </div>
                        <div
                            class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                            Cargado de Evidencias

                            <div class="w-full flex justify-between items-start">
                                <div class="text-grey-darker mt-2 ml-2">
                                    <span class="text-xs flex items-center">
                                        @livewire('evidence.evidence-create', [$school->id])
                                    </span>
                                </div>
                            </div>

                            <div class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                                        <div class="p-2 text-right">
                                            <a wire:click="edit({{ $school->id }})" class="mx-6">
                                                <i class="fa-solid fa-highlighter fill-current text-green-600 cursor-pointer"
                                                    title="{{ __('edit record') . $school->id }}"></i>
                                            </a>
                                            <a wire:click="$emit('deleteSkill',{{ $school->id }})">
                                                <i class="fa-solid fa-delete-left fill-current text-red-600 cursor-pointer"
                                                    title="{{ __('delete record') }}"></i>
                                            </a>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <div class="">
            @livewire('evidence.evidence-list', [$school->id])
           </div>


        @endforeach
    </ul>

    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('edit school') }}
            </div>
            <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/school.jpg') }}"
                alt="{{ auth()->user()->name }}">
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="seleccionadas">
                    <div>
                        <input class="w-full rounded" type="text" placeholder="{{ __('title') }}"
                            wire:model="title" />
                        <x-jet-input-error for="title" />
                    </div>
                </div>

                <div class="seleccionadas">
                    <div>
                        <input class="w-full rounded" type="text" placeholder="{{ __('specialty') }}"
                            wire:model="specialty" />
                        <x-jet-input-error for="specialty" />
                    </div>
                </div>

                <div class="seleccionadas">
                    <div>
                        <input class="w-full rounded" type="text" placeholder="{{ __('university') }}"
                            wire:model="university" />
                        <x-jet-input-error for="university" />
                    </div>
                </div>

                <div class="seleccionadas">
                    <div>
                        <input class="w-full rounded" type="text" placeholder="{{ __('year') }}"
                            wire:model="year" />
                        <x-jet-input-error for="year" />
                    </div>
                </div>

                <div class="seleccionadas">
                    <div>
                        <input class="w-full rounded" type="text" placeholder="{{ __('college') }}"
                            wire:model="college" />
                        <x-jet-input-error for="college" />
                    </div>
                </div>

                <div class="seleccionadas">
                    <div>
                        <input class="w-full rounded" type="text" placeholder="{{ __('number') }}"
                            wire:model="number" />
                        <x-jet-input-error for="number" />
                    </div>
                </div>


            </div>
        </x-slot>
        <x-slot name="footer">
            <button class="bg-red-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-3"
                wire:click="$set('openModal',false)">
                {{ __('cancel') }}
            </button>
            <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded" type="submit"
                wire:click="update">
                {{ __('update') }}
            </button>
        </x-slot>
    </x-jet-dialog-modal>
</section>


@push('script')
    <script>
        livewire.on('deleteSchool', schoolId => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    livewire.emitTo('school.school-list', 'delete', schoolId)

                }
            })
        })
    </script>
@endpush
