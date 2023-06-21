<div>
   <ul class="bg-white shadow rounded">
    @if(auth()->user()->socials)
       @foreach (auth()->user()->socials as $social )
           <li class="p-2 border-b-2 border-gray-300">
               <span>
                     <i class="{{ $social->type }}" ></i>
               </span>
            {{ $social->name }}</li>
       @endforeach
    @endif
   </ul>
</div>
