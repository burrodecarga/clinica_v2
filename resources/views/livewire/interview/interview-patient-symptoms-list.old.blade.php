<div>
    <h1 class="text-gray-600 italic">Motivo de Consulta: </h1>
    <ul>
 @forelse($symptomsList as $s)
 <li class="flex items-center border rounded p-2 bg-white cursor-pointer">{{ $s->name }}</li>
 @empty
 <li>No hay motivos de consulta registrados</li>
 @endforelse
 </ul>
 </div>
