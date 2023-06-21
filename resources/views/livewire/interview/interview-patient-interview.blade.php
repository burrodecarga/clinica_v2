<div class="container grid grid-cols-1 md:grid-cols-4">
    <div class="w-full col-span-4" id="datos-personales-habitos">
        <div class="card">
            <div class="card-body text-gray-500 flex justify-between items-center">
                <h1 class="font-bold text-2xl">{{ __('medical interview').' N° - '.$interview_id.' - '.$patientName }}</h1>
            </div>

            <!-- component -->
            <section class="antialiased bg-gray-100 text-gray-600">
                <div class="flex flex-col justify-center h-full">
                    <!-- Table -->
                    <div class="w-full max-w-7xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                        <header class="px-5 py-4 border-b border-gray-100">

                        </header>
                        <div class="p-3">
                            <div class="overflow-x-auto">
                                <nav class="flex justify-center space-x-4">
                                    <a href="{{ route('interviews.index',$user_id) }}"
                                        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Datos Paciente</a>

                                    @livewire('interview.interview-patient-symptom', ['user_id' => $user_id, 'interview_id' => $interview_id])


                                    @livewire('interview.interview-patient-check', ['user_id' => $user_id, 'interview_id' => $interview_id])


                                    @if($gender == 'femenino')

                                    <a href="/team"
                                        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Femenino</a>
                                        @endif

                                        @livewire('interview.interview-patient-medicines', ['user_id' => $user_id, 'interview_id' => $interview_id])
                                    <a href="/projects"
                                        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Prescription</a>
                                    <a href="/reports"
                                        class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Reports</a>
                                </nav>
                                <div class="grid grid-cols-3">
                                    @livewire('interview.interview-patient-symptoms-list', ['user_id' => $user_id, 'interview_id' => $interview_id])
                                    <section>
                                        <h1 class="px-3 py-2 text-center text-gray-400 text-bold">Resultado de consulta</h1>
                                        <form class="space-y-4 w-full" wire:submit.prevent="save">
                                            <input wire:model="date" type="date" class="w-full rounded"
                                                placeholder="{{ __('date of interview') }}">
                                            <x-jet-input-error for="date" />



                                            <textarea class="w-full rounded" wire:model="suspicion" cols=10 placeholder="{{ __('input suspicion') }}"></textarea>
                                            <x-jet-input-error for="suspicion" />
                                            <textarea class="w-full rounded" wire:model="diagnosis" cols=10 placeholder="{{ __('input diagnosis') }}"></textarea>
                                            <x-jet-input-error for="diagnosis" />
                                            <div class="w-full">


                                                <button
                                                    class="bg-yellow-500 hover:bg-yellow-400 text-white px-4 py-2 rounded mx-1 ">{{ __('cancel') }}</button>
                                                <button
                                                    class="bg-green-500  hover:bg-green-400 text-white px-4 py-2 rounded mx-1"
                                                    type="submit">{{ __('create') }}</button>
                                            </div>


                                        </form>

                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{-- fin de síntomas --}}
        </div>

    </div>


</div>
