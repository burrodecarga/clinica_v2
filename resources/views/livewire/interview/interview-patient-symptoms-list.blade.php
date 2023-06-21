<div>
    <h1 class="px-3 py-2 text-center text-gray-400 text-bold">Motivo de Consulta: </h1>
    <ul>
 @forelse($symptomsList as $s)
 <li class="flex items-center border rounded p-2 bg-white cursor-pointer">{{ $s->name }}</li>
 @empty
 <li>No hay motivos de consulta registrados</li>
 @endforelse
 </ul>
 </div>
