<div>
<a href="javascript:void(0)" class="border my-3 p-2 bg-indigo-800 items-center text-white leading-none lg:rounded-md flex lg:inline-flex cursor-pointer hover:bg-green-800" wire:click="show">
    <span class="flex rounded bg-transparent uppercase px-2 py-1 text-xs font-bold mr-3">Quiero Registrarme como Médico de Rokave</span>
</a>
<div class="relative z-10 {{ $open }}" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
          <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-md bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
              </div>
              <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Registrarse como Médico</h3>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">¿Quiere registrarse como Médico?.</p>
                  <p class="text-sm text-gray-500">Al registrarse como médico será rediccionado al login y debe ingresar de nuevo.</p>
                  <p class="text-sm text-gray-500">Al ingresar lo hará con el role de Médico y podrá modificar su perfil.</p>
                  <p class="text-sm text-gray-500">Se le enviará un correo con los requerimientos necesarios</p>
                  <p class="text-sm text-gray-500">
                    Una vez revisado los requerimiento será acreditado como MEDICO de ROKAVE y aparecerá en sus respectivos catálogos
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:flex sm:px-6 gap-4">
            <button wire:click="doctor(1)" type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Registrarse como Médico</button>
            <button wire:click="doctor(0)" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
