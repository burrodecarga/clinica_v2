<div>
    <button wire:click="$set('modal', true)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Gestando
    </button>
    <x-dialog-modal wire:model="modal">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('Historial de Gestación') }}
            </div>
            <div class="text-lg text-gray-500 font-bold text-center mb-2 uppercase">
                {{ __('Datos de última mestruación') }}
            </div>
            @if($pinar)
            <div class="border bg-slate-200 p-6 text-center mb-1 mx-24">
                <h1>PROBABLE FECHA DE PARTO</h1>
                <h1 class="text-xs font-medium">Método PINAR: {{ $pinar}}</h1>
                <h1 class="text-xs font-medium">Método WHAL: {{ $wahl }}</h1>
                <h1 class="text-xs font-medium">Método NAEGUELE: {{ $naeguele }}</h1>
            </div>
            @endif
            <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/control.jpg') }}" alt="">
        </x-slot>
        <x-slot name="content">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <div class="col-span-1 md:col-span-3">
                    <input class="w-full rounded cursor-pointer" type="text" placeholder="{{ __('name') }}"
                        wire:model="name" readonly />
                    <x-input-error for="name" />
                </div>
                <div>
                    <label for="last">Última Mestruación</label>
                    <input class="w-full rounded cursor-pointer" type="date" placeholder="{{ __('última Mestruación') }}"
                        wire:model="last" title="Última Mestruación" autofocus="autofocus"/>
                    <x-input-error for="last" />
                </div>
                <div>
                    <label for="cycle">Ciclo Mestrual promedio</label>
                    <input class="w-full rounded cursor-pointer" type="number" placeholder="{{ __('Ciclo de Mestruación') }}"
                        wire:model="cycle" />
                    <x-input-error for="cycle" />
                </div>
                <div>
                    <label for="flow">Flujo Mestrual Promedio</label>
                    <input class="w-full rounded cursor-pointer" type="number" placeholder="{{ __('Días de Mestruación') }}"
                        wire:model="flow" />
                    <x-input-error for="flow" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button class="bg-red-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-3"
                wire:click="$set('modal',false)">
                {{ __('cancel') }}
            </button>
            <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded mx-3" wire:click="addGesta">
                {{ __('guardar') }}
            </button>
        </x-slot>
    </x-dialog-modal>

</div>
