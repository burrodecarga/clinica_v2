<x-guest-layout>
    <section>
       @include('partials.part1')
        <div class="my-2"/>
        @include('partials.part2')
        <div class="my-2"/>
        @include('partials.part3')
        <div class="my-2"/>
        @include('partials.part4')
        @if(auth()->user())
        <div class="my-2"/>
        <article>
            @livewire('patient.patient-info')
        </article>
        @endif
        <div class="my-2"/>
        @include('partials.caeer')
        <div class="my-2"/>
        @include('partials.inter')
        <div class="my-2"/>
        @include('partials.control')
        <div class="my-2"/>
        @include('partials.iniciar')
        <div class="my-2"/>
        @include('partials.servicios')
        <div class="my-2"/>
        @include('partials.acerca')
    </section>
    <footer id="footer" class="text-gray-100 bg-gray-800 grid grid-cols-2 md:grid-cols-5 justify-center justify-items-center p-4 my-2">
        <div class="col-span-2 md:col-span-1">
            <img class="h-20 w-20" src="{{ asset('assets/edwin.png') }}" alt="{{ __('logo') }}">
        </div>
        <div>
            <h3 class="font-bold capitalize">{{ __('Para Pacientes') }}</h3>
            <ul>
                <a href="#caeer">
                <li class="text-sm capitalize cursor-pointer">{{ __('caeer advise') }}</li>
                </a>
                <a href="#inter">
                <li class="text-sm capitalize cursor-pointer">{{ __('profesional interviews') }}</li>
                </a>
                <a href="#control">
                <li class="text-sm capitalize cursor-pointer">{{ __('control of interviews and medical history') }}</li>
                </a>

            </ul>
        </div>

        <div>
            <h3 class="font-bold capitalize">{{ __('Para Médicos') }}</h3>
            <ul>
                <a href="#iniciar">
                <li class="text-sm capitalize">{{ __('get starter') }}</li></a>
                <a href="#servicios">
                <li class="text-sm capitalize">{{ __('our services') }}</li></a>
                <a href="#acerca">
                <li class="text-sm capitalize">{{ __('about us') }}</li></a>

            </ul>
        </div>
        <div class="col-span-2">
            <h3 class="font-bold capitalize text-center">{{ __('contactanos') }}</h3>
            <ul>
                <li class="text-sm"><i class="fas fa-map-marker-alt mr-2"></i>calle san juan n° 182-33, Valle
                    Verde, Naguanagua</li>
                <li class="text-sm"><i class="far fa-envelope mr-2"></i>edwinhenriquezh@gmail.com</li>
                <li class="text-sm capitalize"><i class="fas fa-phone mr-2"></i>+58 4144753555</li>
            </ul>
        </div>
        <div class="col-span-5 gap-10">
            <a href="#" class="px-4 py-2"><i class="fab fa-facebook"></i></a>
            <a href="#" class="px-4 py-2"><i class="fab fa-instagram"></i></a>
            <a href="#" class="px-4 py-2"><i class="fab fa-twitter"></i></a>
            <a href="#" class="px-4 py-2"><i class="fab fa-linkedin"></i></a>
        </div>
    </footer>
    <div class="w-full text-center bg-gray-800 text-white border-y">ROKAVE 2022</div>
    @push('script')
    <script>
       window.addEventListener('load', event =>{
          interval = localStorage.getItem('interval')
          doctor_id = localStorage.getItem('doctor_id')
          specialty_id = localStorage.getItem('specialty_id')
          day = localStorage.getItem('day')
          date = localStorage.getItem('date')
          price = localStorage.getItem('price')
          office = localStorage.getItem('office')

          if(interval !==null) {
            Swal.fire({
      title: 'Crear una cita médica ?',
      text: "Tiene una cita médica que no se ha registrado aún, quiere registrala?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Crear cita médica'
    }).then((result) => {
      if (result.isConfirmed) {

       livewire.emitTo('patient.patient-date','addAppoinment',interval,
    doctor_id,
    specialty_id,
    day,
    date,
    price,
    office) //creamos la cita
      }else{
        localStorage.removeItem('interval')
            localStorage.removeItem('doctor_id')
            localStorage.removeItem('specialty_id')
            localStorage.removeItem('day')
            localStorage.removeItem('date')
            localStorage.removeItem('price')
            localStorage.removeItem('office')
      }
    })

          }

       })

    </script>
     @endpush

</x-guest-layout>
