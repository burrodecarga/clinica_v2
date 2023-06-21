
 <form wire:submit.prevent="save" class="w-full max-w-sm flex">
    <div class="flex items-center border-b border-teal-500 py-2">
      <input wire:model="file" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="file" aria-label="Full name">
      <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
        guardar
      </button>
    </div>
    @error('file') <span class="text-danger">{{ $message }}</span> @enderror
    @if($file && $file->extension()<>'pdf')
     <img src="{{ $file->temporaryURL() }}" alt="" class="h-16 w-16 object-cover ml-6">
    @endif
    <div wire:loading wire:target="file">Uploading...</div>
  </form>
