<div class="flex flex-col border p-4 items-center justify-center rounded bg-gray-100">
    <h1 class="text-xl font-bold text-gray-600 w-full py-6 px-4 text-center uppercase">{{ __('patient interview') }}
    </h1>
    <div class="my-4 w-full">
        @livewire('patient.patient-symptom',['user_symptoms_id'=>$this->symptoms_id])
    </div>
    <form class="space-y-4 w-full" wire:submit.prevent="save">
        <input wire:model="date" type="date" class="w-full rounded" placeholder="{{ __('date of interview') }}">
        <x-input-error for="date" />


        @if (count($symptoms_text) > 0)
            <p class="px-4 py-2 bg-red-600 text-white text-sm">
                @foreach ($symptoms_text as $st)
                    {{ $st }},
                @endforeach
            </p>
        @endif

        <textarea class="w-full rounded" wire:model="suspicion" cols=10 placeholder="{{ __('input suspicion') }}"></textarea>
        <x-input-error for="suspicion" />
        <textarea class="w-full rounded" wire:model="diagnosis" cols=10 placeholder="{{ __('input diagnosis') }}"></textarea>
        <x-input-error for="diagnosis" />
        <div class="w-full">


            <button
                class="bg-yellow-500 hover:bg-yellow-400 text-white px-4 py-2 rounded mx-1 ">{{ __('cancel') }}</button>
            <button class="bg-green-500  hover:bg-green-400 text-white px-4 py-2 rounded mx-1"
               type="submit">{{ __('create') }}</button>
        </div>
    </form>
</div>
