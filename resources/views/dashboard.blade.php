<x-app-layout>
    <div class="bg-red-500">
        <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (auth()->user())
                {{ auth()->user()->name }}
            @else
                <script>
                    window.location = "{{ route('login') }}";
                </script>
                <?php exit(); ?>
            @endif
        </h2>
    </x-slot></div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl border-t sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h1 class="mt-8 text-2xl font-medium text-gray-900">
                        Historial Médico
                    </h1>

                    <p class="mt-6 text-gray-500 leading-relaxed">
                        <span class="font-bold text-gray-600">{{ auth()->user()->name }}, </span>
                        paciente de
                        <span class="font-medium text-gray-600 underline italic">sexo: {{ auth()->user()->gender  }}</span>     de

                        @if(\Carbon\Carbon::parse(auth()->user()->birthdate)->age>0)
                        <span class="font-medium text-gray-600 underline italic">
                        {{ \Carbon\Carbon::parse(auth()->user()->birthdate)->age }} año(s) de edad
                        </span>
                        @else
                        <span class="font-medium text-gray-600 underline italic">
                        {{ \Carbon\Carbon::parse(auth()->user()->birthdate)->week() }} semana(s) de edad
                        </span>
                        @endif
                      is designed
                        to help you build your application using a development environment that is simple, powerful, and
                        enjoyable. We believe
                        you should love expressing your creativity through programming, so we have spent time carefully
                        crafting the Laravel
                        ecosystem to be a breath of fresh air. We hope you love it.
                    </p>
                </div>
                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                    <div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                <a href="https://laravel.com/docs">Citas Médicas</a>
                            </h2>
                        </div>
                        @include('partials.ta')
                    </div>
                    <div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                <a href="https://laravel.com/docs">Entrevistas Médicas</a>
                            </h2>
                        </div>
                        @include('partials.te')
                    </div>

                </div>
                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 p-6 lg:p-8 minimo">
                    <div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                <a href="https://laravel.com/docs">Cirigías</a>
                            </h2>
                        </div>
                        @include('partials.to')
                    </div>
                    <div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                <a href="https://laravel.com/docs">Sintomatologías</a>
                            </h2>
                        </div>
                        @include('partials.tsintomas')
                    </div>
                    <div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                <a href="https://laravel.com/docs">Vacunas</a>
                            </h2>
                        </div>
                        @include('partials.tvacunas')
                    </div>
                </div>
                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 p-6 lg:p-8 minimo">

                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                <a href="https://laravel.com/docs">patologías</a>
                            </h2>
                        </div>
                        @include('partials.tpatologias')
                    </div>
                    <div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                <a href="https://laravel.com/docs">Medicinas</a>
                            </h2>
                        </div>
                        @include('partials.tmedicinas')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
