<div class="container grid grid-cols-1 md:grid-cols-4">
    <div class="w-full col-span-4" id="datos-personales-habitos">
        <div class="card">
            <div class="card-body text-gray-500 flex justify-between items-center">
                <h1 class="font-bold text-2xl">{{ __('medical interviews') }}</h1>
                <a href="{{ route('interviews.create',$user_id) }}">
                <button                     class="text-red-800 hover:text-green-700 hover:transform hover:scale-150"
                    title="entrevistar al paciente">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button></a>
            </div>

            <!-- component -->
           <section class="antialiased bg-gray-100 text-gray-600">
                <div class="flex flex-col justify-center h-full">
                    <!-- Table -->
                    <div class="w-full max-w-7xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                        <header class="px-5 py-4 border-b border-gray-100 text-center">          <h1>Entrevistas Médicas Anteriores</h1>
                        </header>
                        <ul>
                     @forelse($userInterviews as $s)
                     <li class="flex items-center border rounded p-2 bg-white cursor-pointer justify-between">
                        <span>
                            <small>
                                {{ $s->date->format('d-m-Y') }}
                            </small>

                            <small class="font-bold">Doctor: {{ $s->Doctor }}</small>

                        </span>
                        <span class="text-sm mx-4 italic">
                            {{ $s->diagnosis }}
                        </span>





                    </li>
                     @empty
                     <li>No hay motivos de consulta registrados</li>
                     @endforelse
                     </ul>

                    </div>
                </div>
            </section>
        </div>
    </div>

</div>
