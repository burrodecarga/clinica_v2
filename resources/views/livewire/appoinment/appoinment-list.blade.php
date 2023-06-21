<div class="w-full rounded-lg bg-white shadow-lg p-8 border">
   <small>
    <h1 class="border rounded font-bold text-center py-2 uppercase text-gray-700 mb-2">{{ __('list of appointment') }}<span class="inline-flex items-center justify-center px-2 py-1 mx-4 text-xs font-bold leading-none text-red-100 bg-green-600 rounded-full text-white">{{ $appoinments->count() }}</span></h1>
       <div>
       <select class="rounded w-full border shadow-sm" wire:model="days">
           <option value="00"> {{ __('today') }}</option>
           <option value="05"> {{ __('next 5 days') }}</option>
           <option value="15">{{ __('next 15 days') }}</option>
       </select>
   </div>
   <div>
       @forelse ($appoinments as $appoinment)
           <div class="mt-4">
               <div class="flex items-center w-full p-2 mx-auto my-2 bg-white rounded-lg border shadow-sm">
                   <a class="mx-4"href="#">
                       <img class="w-10 h-10 object-cover rounded-full" src="{{ $appoinment->patient->profile_photo_url }}" alt="{{ $appoinment->patient->name}}">
                   </a>
                   <p class="font-bold text-gray-700 hover:underline">{{ $appoinment->patient->name}}</p>

               </div>
               <a href="#" class="px-1 py-1 w-full bg-gray-400 block text-white text-center hover:bg-red-600">{{ $appoinment->specialty->name }}
            </a>
           </div>
           <p class="flex flex-col w-full items-center font-light gap-2 border">
               <span>{{ $appoinment->status }}</span>
               <span>{{  \Carbon\Carbon::parse($appoinment->date)->format('d-m-Y') }}</span>
               <span>{{  \Carbon\Carbon::parse($appoinment->hour)->format('g:ia') }}</span>
               <span>{{ $appoinment->office }}</span>
               <span>{{ $appoinment->price }}</span>
               <span class="mx-4 text-justify">{{ $appoinment->description }}</span>
           </p>
           <div class="flex items-center justify-between mt-6">
            <a class="px-4 py-1 bg-green-600 text-white" href="#" wire:click="confirmed({{ $appoinment->id }})">{{ __('confirmed') }}</a>
            <a class="px-4 py-1 bg-red-600 text-white" href="#"
            wire:click="canceled({{ $appoinment->id }})">{{ __('canceled') }}</a>
            <a class="px-4 py-1 bg-blue-600 text-white" href="{{ route('interviews.index',$appoinment->patient_id) }}">{{ __('go to interview') }}</a>
        </div>
       @empty
       <h1 class="border rounded my-6 font-bold text-center py-2 uppercase text-red-700 mb-2">{{ __('no appointments recorded') }}<span class="inline-flex items-center justify-center px-2 py-1 mx-4 text-xs font-bold leading-none text-red-100 bg-green-600 rounded-full text-white">{{ $appoinments->count() }}</span></h1>
       @endforelse
       @if ($appoinments->count() > 0)
       <div class="flex justify-between text-xs my-3">
           {{ $appoinments->links('vendor.livewire.simple-tailwind') }}
       </div>
       @endif
   </div>

   </small>
</div>
