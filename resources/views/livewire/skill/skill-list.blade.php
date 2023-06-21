<section class="text-gray-700 rounded">
    <ul class="w-full justify-start">
        @foreach ($skills as $skill)

<!-- component -->
<div class="bg-blue w-full p-8 flex justify-center font-sans">
    <div class="rounded bg-grey-light w-full p-2">
      <div class="flex justify-between py-1">
          <h3 class="text-sm font-bold">  {{ $skill->specialty }}</h3>
        <svg class="h-4 fill-current text-grey-dark cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5 10a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4zm7 0a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4zm7 0a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4z"/></svg>
      </div>
      <div class="text-sm mt-2">
          <div class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
            {{ $skill->title }}
        </div>



          <div class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
            {{ $skill->description }}
              <div class="text-grey-darker mt-2 ml-2 flex justify-between items-start">
                  <span class="text-xs flex items-center">

                  </span>
                  <img src="{{ auth()->user()->profile_photo_url }}" class="w-16 h-16 rounded-full" alt="foto de perfil de {{ auth()->user()->name }}" title="foto de perfil de {{auth()->user()->name}}"/>
              </div>
        </div>
        <div class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
            <div class="p-2 text-right">

                <a wire:click="edit({{ $skill->id }})" class="mx-6" >
                    <i class="fa-solid fa-highlighter fill-current text-green-600 cursor-pointer" title="{{ __('edit record').$skill->id }}"
                    ></i>
                </a>
                <a wire:click="$emit('deleteSkill',{{ $skill->id }})">
                    <i class="fa-solid fa-delete-left fill-current text-red-600 cursor-pointer" title="{{ __('delete record') }}"
                    ></i>
                </a>

            </div>
           </div>
      </div>
    </div>
    </div>
        @endforeach
    </ul>

    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            <div class="text-xl text-gray-500 font-bold text-center mb-2 capitalize">
                {{ __('add skill') }}
            </div>
            <img class="h-32 w-full object-center object-cover" src="{{ asset('assets/banner-skill.jpg') }}"
                alt="{{ auth()->user()->name }}">
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 gap-6">
                <div class="aseleccionar">
                    <select class="w-full rounded" wire:model="specialty">
                        <option value="">{{__('select specialty') }}</option>
                        @foreach ($specialties as $s)
                            <option value="{{ $s->name }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="specialty"/>
                </div>
                <div class="seleccionadas">
                    <div>
                        <input class="w-full rounded" type="text" placeholder="{{ __('title') }}" wire:model="title"/>
                        <x-input-error for="title"/>
                    </div>
                </div>

                <div class="seleccionadas">
                    <div>
                        <textarea class="w-full rounded" type="textarea" placeholder="{{ __('description') }}" wire:model="description" /></textarea>
                        <x-input-error for="description"/>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button class="bg-red-500 text-white hover:bg-red-400 px-4 py-2 rounded mx-3"
                wire:click="$set('openModal',false)">
                {{ __('cancel') }}
            </button>
            <button class="bg-green-500 text-white hover:bg-green-400 px-4 py-2 rounded"
           type="submit" wire:click="update">
                {{ __('update') }}
            </button>
        </x-slot>
    </x-dialog-modal>
</section>


@push('script')
<script>
livewire.on('deleteSkill', skillId=>{
    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
   livewire.emitTo('skill.skill-list','delete',skillId)

  }
})
})

</script>
@endpush


