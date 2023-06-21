<x-doctor-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight py-2 px-3">
                @if (auth()->user())
                    {{ auth()->user()->name }}
                @else
                    <script>
                        window.location = "{{ route('login') }}";
                    </script>
                    <?php exit(); ?>
                @endif
            </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="">
                   @livewire('patient.patient-list')
            </div>
            <div class="">
                @livewire('appoinment.appoinment-list')
         </div>
         <div>
            @livewire('schedulle.schedulle')
        </div>
        </div>

    </x-slot>
</x-doctor-layout>
