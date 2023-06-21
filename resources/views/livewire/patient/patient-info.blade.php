<div id="historial" class="bg-gradient-to-tr from-blue-800 via-gray-600 to-blue-600">
    <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
        <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
            <div>
                <p
                    class="inline-block px-3 py-px mb-4 text-xs font-semibold tracking-wider text-white uppercase rounded-full bg-teal-accent-400">
                    {{ __('patient info') }}
                </p>
            </div>
            <h2
                class="max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-white sm:text-4xl md:mx-auto">
                <span class="relative inline-block">
                    <svg viewBox="0 0 52 24" fill="currentColor"
                        class="absolute top-0 left-0 z-0 hidden w-32 -mt-8 -ml-20 text-blue-gray-100 lg:w-32 lg:-ml-28 lg:-mt-10 sm:block">
                        <defs>
                            <pattern id="27df4f81-c854-45de-942a-fe90f7a300f9" x="0" y="0"
                                width=".135" height=".30">
                                <circle cx="1" cy="1" r=".7"></circle>
                            </pattern>
                        </defs>
                        <rect fill="url(#27df4f81-c854-45de-942a-fe90f7a300f9)" width="52" height="24"></rect>
                    </svg>
                    <span class="relative text-white">{{ auth()->user()->name }}</span>
                </span>
            </h2>
            <p class="text-base text-white md:text-lg">
                Si desea ver la totalidad de su historial médico
                pulse ->
                <a href="{{ route('info') }}" class="font-bold text-white px-4 py-2 bg-blue-500 rounded">
                    aquí.
                </a>
            </p>
            <a href="#inicio"
                class="mx-auto w-44 text-white px-4 py-2 bg-pink-600 hover:bg-yellow-500 flex items-center justify-center border text-base font-medium rounded-md shadow-sm sm:px-8 focus:ring focus:ring-offset-1">Ir
                al Principio</a>
        </div>
        <div class="grid max-w-screen-lg gap-8 row-gap-10 mx-auto lg:grid-cols-2">
            <div class="flex flex-col max-w-md sm:mx-auto sm:flex-row">
                <div class="mr-4">
                    <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-indigo-50">
                        <svg class="w-10 h-10 text-deep-purple-accent-400" stroke="currentColor" viewBox="0 0 52 52">
                            <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"
                                points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                        </svg>
                    </div>
                </div>
                @include('partials.appoinments')
            </div>
            <div class="flex flex-col max-w-md sm:mx-auto sm:flex-row">
                <div class="mr-4">
                    <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-indigo-50">
                        <svg class="w-10 h-10 text-deep-purple-accent-400" stroke="currentColor" viewBox="0 0 52 52">
                            <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"
                                points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                        </svg>
                    </div>
                </div>
                @include('partials.interviews')
            </div>
            <div class="flex flex-col max-w-md sm:mx-auto sm:flex-row">
                <div class="mr-4">
                    <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-indigo-50">
                        <svg class="w-10 h-10 text-deep-purple-accent-400" stroke="currentColor" viewBox="0 0 52 52">
                            <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"
                                points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                        </svg>
                    </div>
                </div>
                @include('partials.files')
            </div>
            <div class="flex flex-col max-w-md sm:mx-auto sm:flex-row">
                <div class="mr-4">
                    <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-indigo-50">
                        <svg class="w-10 h-10 text-deep-purple-accent-400" stroke="currentColor" viewBox="0 0 52 52">
                            <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"
                                points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                        </svg>
                    </div>
                </div>
            @include('partials.medicines')
            </div>
        </div>
    </div>
</div>
