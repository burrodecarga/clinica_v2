<section class="mx-auto my-0" >


    <div class="bg-gradient-to-br from-black to-blue-600 text-center py-6">
        <input placeholder="{{ __('find doctor') }}" class="w-1/2 mx-auto rounded" type="text" wire:model="search" />
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2  justify-between items-center gap-4 p-6">
        @foreach ($doctors as $doctor)
            <div class="">
                <div>
                    @foreach ($doctor->specialties as $specialty)
                    <a class="cursor-pointer" wire:click="selectDate({{ $doctor->id }},{{ $specialty->id }})">
                        <div class="p-2">
                            <div class="flex items-start bg-blue-500 px-4 py-2">
                                <div class="flex-shrink-0 h-10 w-10 rounded-r-lg">
                                    <img class="h-10 w-10 rounded-full"
                                    src="{{ $doctor->profile_photo_url }}" alt="{{ $doctor->name }}"/>
                                </div>
                                <div class="ml-4 text-justify capitalize">
                                    <div class="text-sm font-medium text-white">{{ $doctor->name }}</div>
                                    <div class="text-sm font-medium text-white">{{ $specialty->name }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <span class="mx-7">
        {{ $doctors->links() }}
    </span>
</section>
