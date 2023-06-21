<div class="p-6 bg-gray-200">
    <article class="bg-white text-gray-600 text-center mx-auto ">
        <h1 class="text-center px-4 py-2 border bg-white font-bold text-sm uppercase mb-4 text-gray-500">
            {{ __('interview resume') }}: {{ $patient->name }}</h1>
        <p class="text-sm text-gray-500">{{ $interview->date->diffForHumans() }}</p>
        <hr>
        @if ($patient_symptoms)
            <ul>
                @foreach ($patient_symptoms as $ps)
                    <li class="text-sm italic">{{ $ps->name }}</li>
                @endforeach
            </ul>
        @endif

        <h2 class="text-center px-4 py-2 border bg-white font-bold text-sm uppercase mb-4 text-gray-500">
            {{ __('suspicion') }} </h2>
        <p class="text-sm italic text-gray-500">
            {{ $interview->suspicion }}
        </p>
        <h2 class="text-center px-4 py-2 border bg-white font-bold text-sm uppercase mb-4 text-gray-500">
            {{ __('diagnosis') }} </h2>
        <p class="text-sm italic text-gray-500">
            {{ $interview->diagnosis }}
        </p>


    </article>
</div>
