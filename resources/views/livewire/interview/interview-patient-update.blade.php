<div class="container grid grid-cols-1 md:grid-cols-4">
    <div class="w-full col-span-4" id="datos-de-paciente">
        <div class="card">
            <div class="card-body text-gray-500">
                <h1 class="font-bold text-2xl">Datos del Paciente {{ $user->name }}</h1>
                <hr class="mt-2 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-4">
                    <figure>
                        @if ($user->profile_photo_path)
                            <img src="{{ Storage::url($user->profile_photo_path) }}"
                                class="w-full object-cover object-center" />
                        @else
                            <img class="w-full object-cover object-center max-h-64"
                                src="{{ asset('img/profile.png') }}" />
                        @endif
                    </figure>
                    <aside class="p-4 text-gray-500 shadow">
                        <p>{{ $user->name }}</p>
                        <p>{{ $user->gender }}</p>
                        <p>
                            @if ($user->birthdate)
                                {{ __('age') . ': ' }}
                                {{ $user->age() . ' años' }}
                            @endif
                        </p>

                    </aside>
                </div>

                <form wire:submit.prevent="update">
                    <div class="grid grid-cols-1 md:grid-cols-3 w-full gap-2">
                        <div class="mb-4 col-span-1">
                            <label for="cedula" class="block">cedula</label>
                            <input wire:model="cedula" type="text" class="w-full mt-1 rounded-lg"
                                placeholder="ingrese cedula">
                            <x-jet-input-error for="cedula" />
                        </div>
                        <div class="col-span-2">
                            <label for="name" class="block">nombre</label>
                            <input wire:model="name" type="text" class="w-full mt-1 rounded-lg"
                                placeholder="ingrese name">
                            <x-jet-input-error for="name" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-2">
                        <div class="mb-4 col-span-1">
                            <label for="gender" class="block">sexo</label>
                            <select wire:model="gender" class="w-full mt-1 rounded-lg">
                                <option value="femenino">femenino</option>
                                <option value="masculino">masculino</option>
                            </select>
                            <x-jet-input-error for="gender" />
                        </div>

                        <div class="mb-4 col-span-1">
                            <label for="birthdate" class="block">fecha de nacimiento</label>
                            <input wire:model="birthdate" type="date" class="w-full mt-1 rounded-lg"
                                value="{{ old('birthdate', $user->birthdate) }}">
                            <x-jet-input-error for="birthdate" />
                        </div>

                        <div class="mb-4 col-span-1">
                            <label for="phone" class="block">phone</label>
                            <input wire:model="phone" type="text" class="w-full mt-1 rounded-lg"
                                placeholder="ingrese phone">
                            <x-jet-input-error for="phone" />
                        </div>

                        <div class="mb-4 col-span-1">
                            <label for="email" class="block">email</label>
                            <input wire:model="email" type="text" class="w-full mt-1 rounded-lg"
                                placeholder="ingrese email">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 mb-4">
                        <label for="address" class="block">address</label>
                        <input wire:model="address" type="text" class="w-full mt-1 rounded-lg"
                            placeholder="ingrese address">
                        <x-jet-input-error for="address" />
                    </div>

                    <button type="submit" class="btn btn-blue rounded-lg">actualizar datos</button>
                    <div wire:loading wire:target="update" class="btn btn-green rounded-lg bg-green-100 text-gray-500">
                        actualizando datos...
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
