<div class="grid grid-cols-1 md:grid-cols-4 gap-2">
    <h1 class="col-span-full text-center text-gray-500">Evidencias consignadas</h1>
    @foreach ($evidencias as $evidencia)
        <div class="m-auto">
            <span class="text-xs flex items-center">
                {{ $evidencia->title }}
            </span>
            @if ($evidencia->file_extension != 'pdf')
                <img src="{{ Storage::url($evidencia->file_path) }}" class="w-32 h-32 object-cover rounded" />
            @else
                <div class="bg-red-300">
                    <a href="{{ Storage::url($evidencia->file_path) }}" target="_blank"
                        class=" bg-gray-400 text-black w-32 h-32 rounded"><img src="{{ asset('assets/pdf.jpg') }}"
                            alt="pdf icon"></a>

                </div>

            @endif
            <button wire:click="delete({{ $evidencia->id }})"><i class="fa-regular fa-trash-can text-red-500"></i></button>
        </div>
    @endforeach
</div>
