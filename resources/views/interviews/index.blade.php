<x-doctor-layout>
    <section>
        <h1 class="text-center text-2xl font-semibold text-gray-400 py-3">{{ __("patient's data") }} : <span class="text-sm font-bold italic">{{ auth()->user()->name }}</span>    </h1>
    </section>
    <div class="container mx-auto bg-red-200 my-5 p-5">
        <section class="px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="col-span-1 md:col-span-3">
                    <div>
                        <div class="bg-white p-3 border-t-4 border-green-400">
                            <div class="image overflow-hidden">
                                <img class="w-10 h-10 object-cover rounded-full mx-4" src="{{ $user->profile_photo_url }}"
                                alt="{{ $user->name }}">
                            </div>
                            <h1 class="text-center font-bold text-gray-900 leading-8 my-1">{{ $user->name }}</h1>
                            <h3 class="text-justify font-light text-gray-600 leading-6">
                                No hay registro
                            </h3>
                            <p class="text-sm font-extralight text-gray-500 leading-8 my-1">
                                no hay datos
                            </p>
                            <ul class="bg-gray-300 rounded p-3 text-gray-500">
                                @if($user->gender =='femenino')
                                <li class="flex items-center py-3">
                                    <span>status</span>
                                    @if($user->pregnants()->where('active',1)->count()==0)
                                    <span
                                        class="ml-auto bg-green-700 text-white px-2 py-1 text-sm cursor-pointer rounded">
                                        @livewire('patient.patient-gesta',['user'=>$user->id])
                                    </span>
                                    @else
                                    <span
                                        class="ml-auto bg-green-700 text-white px-2 py-1 text-sm cursor-pointer rounded">
                                        CONTROL
                                    </span>
                                    @endif
                                @endif

                                </li>
                                <li class="flex items-center py-3 capitalize">
                                    <span>{{ __('member since') }}</span>
                                    <span class="ml-auto">{{ $user->created_at->format('d-m-Y') }}</span>
                                </li>
                            </ul>
                        </div>
                        <div>
                    </div>
                    </div>
                </div>
                <div class="col-span-1 md:col-span-9 bg-white rounded p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 text-gray-400">
                        <div class="flex text-sm">
                            <p class="px-4 py-2 font-semibold capitalize">{{ __('name') }} :</p>
                            <p class="px-4 py-2 font-semibold capitalize">{{ $user->name }}</p>
                        </div>
                        <div class="flex">
                            <div class="px-4 py-2 font-semibold capitalize">{{ __('age') }} : </div>

                            @if ($user->birthdate)
                                <div class="px-4 py-2 capitalize">{{ __('born') }}
                                    {{  \Carbon\Carbon::parse($user->birthdate)->diffForHumans(['parts' => 2, 'join' => true]) }}
                                </div>
                            @endif
                        </div>
                        <div class="flex text-sm">
                            <p class="px-4 py-2 font-semibold capitalize">{{ __('gender') }} :</p>
                            <p class="px-4 py-2 font-semibold capitalize">{{ $user->gender }}</p>
                        </div>
                        <div class="flex text-sm">
                            <p class="px-4 py-2 font-semibold capitalize">{{ __('contact') }} :</p>
                            <p class="px-4 py-2 font-semibold capitalize">{{ $user->phone }}</p>
                        </div>
                        <div class="flex text-sm">
                            <p class="px-4 py-2 font-semibold capitalize">{{ __('birthdate') }} :</p>
                            @if ($user->birthdate)
                            <p class="px-4 py-2 font-semibold capitalize">{{  \Carbon\Carbon::parse($user->birthdate)->format
                            ('d-m-Y') }}</p>
                            @endif

                        </div>
                        <div class="flex text-sm">
                            <p class="px-4 py-2 font-semibold capitalize">{{ __('email') }} :</p>
                            <p class="px-4 py-2 font-semibold capitalize">{{ $user->email }}</p>
                        </div>

                        <div class="flex text-sm">
                            <p class="px-4 py-2 font-semibold capitalize">{{ __('address') }} :</p>
                            <p class="px-4 py-2 font-semibold capitalize">{{ $user->address }}</p>
                        </div>
                        <a href="#" class="px-6 py-3 bg-gray-300 col-span-full hover:text-gray-600 text-center text-black my-12">{{ __('show full information') }}</a>
                    </div>

                </div>
            </div>
        </section>
        <section class="my-6">
            <div class="grid grid-cols-1 md:grid-cols-3 text-gray-400 gap-4">
                <div class="col-span-3 md:col-span-2">
                    @livewire('patient.patient-interview',['user'=>$user->id])
                </div>

                <div class="col-span-3 md:col-span-1">
                    @livewire('patient.patient-list-interview',['user'=>$user->id])
                    <div class="my-1" />
                    @livewire('patient.patient-appoinment',['user'=>$user->id])
                </div>

            </div>
        </section>
        <section  class="my-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <div id="datos-de-enfermedades">
            @livewire('patient.patient-disase',['user'=>$user->id])
                </div>
                <div id="datos-de-cirugias">
            @livewire('patient.patient-surgery',['user'=>$user->id])
                </div>
            </div>
        </section>
        <section id="datos-de-alergias" class="my-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <div>
                    @livewire('interview.interview-patient-allergy',['user'=>$user->id])
                </div>
                <div>
                    @livewire('interview.interview-patient-vaccine',['user'=>$user->id])
                </div>

            </div>
        </section>
    </div>
</x-doctor-layout>
