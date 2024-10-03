<div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Gestión de Tareas</h1>
        <button 
            class="bg-blue-500 text-white px-2 sm:px-4 py-2 rounded-md hover:bg-blue-600 transition"
            onclick="document.getElementById('create-task-modal').classList.remove('hidden')">
            + Nueva Tarea
        </button>
    </div>

    <!-- Filtros -->
    <div class="mb-6">
        <input 
            type="text" 
            placeholder="Buscar por título..." 
            wire:model.live="filterTitle"
            class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full sm:w-1/3 mb-2"
        />
        <select class="px-2 sm:px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent mb-2" 
            {{-- si se hace un cambio filtar por el status del valor del option --}}
            wire:change="filterByStatus($event.target.value)"
            wire:model="filterStatus">
            <option value="">Todos los estados</option>
            <option value="1">Pendientes</option>
            <option value="2">Completadas</option>
        </select>


        <input 
            type="date" 
            wire:change="filterByDate($event.target.value)"
            wire:model="date"
            class="px-2 sm:px-4  py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        />
        <button 
           wire:click="resetAllFilters" 
           class="px-2 sm:px-4  pt-1 pb-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
           <i class="material-icons">restart_alt</i>
        </button>
    </div>

    <!-- Lista de Tareas -->
    <div class="bg-white shadow-md rounded-md overflow-hidden scroll-x">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-600">
                    <th class="px-6 py-4">Tarea</th>
                    <th class="px-6 py-4">Estado</th>
                    <th class="px-6 py-4">Fecha</th>
                    <th class="px-6 py-4">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                {{-- iteramos entre las tareas guardadas del usuario --}}
                @foreach ( $tasks as $task )
                <tr class="border-b hover:bg-gray-50">
                    {{-- Aquí la condicional si status 2 es completado el titulo será puesto  line-through--}}
                    @if ($task->status == '1')
                    <td class="px-6 py-4">{{$task->title}}</td>
                    @else
                    <td class="px-6 py-4 line-through">{{$task->title}}</td>
                    @endif
                    <td class="px-6 py-4">
                         {{-- Aquí la condicional si status 1 es pendiente 2 es completado --}}
                        @if ($task->status == '1')
                        <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-md">Pendiente</span>
                        @else
                        <span class="bg-gray-200 text-gray-500 px-2 py-1 rounded-md">completada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{$task->date}}</td>
                    <td class="px-6 py-4 flex space-x-2">
                        <button class="bg-green-500 text-white px-2 py-1 rounded-md hover:bg-green-600 transition"
                            wire:click='check({{ $task->id }})'>
                            <i class="material-icons">check</i>
                        </button>
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-md hover:bg-yellow-600 transition"
                            wire:click="edit({{ $task->id }}, {{ $task->status }})">   
                            <i class="material-icons">edit</i>
                        </button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600 transition"
                            wire:click="confirmDelete({{ $task->id }}, '{{$task->title}}')">
                            <i class="material-icons">delete</i>
                        </button>
                    </td>
                </tr>
                @endforeach
                <!-- Repetir la fila por cada tarea -->
            </tbody>
        </table>
    </div>

    <!-- Card para CREAR Tarea -->
    <div id="create-task-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-80 sm:w-1/2 p-6">
            <h2 class="text-2xl font-bold mb-4">Crear Nueva Tarea</h2>
            <form wire:submit='save'>
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <input 
                        type="text" 
                        id="title" 
                        wire:model='taksCreate.title'
                        name="title" 
                        class="mt-1 px-4 py-2 border border-gray-300 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    >
                    @error('taksCreate.title') <span class="error text-red-500 text-xs" >{{ $message }}</span> @enderror
                </div>
                
                <div class="flex justify-end">
                    <button 
                        type="button" 
                        class="mr-2 bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition" 
                        onclick="document.getElementById('create-task-modal').classList.add('hidden')">
                        Cancelar
                    </button>
                    <button 
                        type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Card para EDITAR Tarea -->
    <div x-data="{ show: @entangle('editOpen') }" x-show="show" x-cloak class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-80 sm:w-1/2 p-6">
            <h2 class="text-2xl font-bold mb-4">Editar Tarea</h2>
            <form wire:submit.prevent="updateTask">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <input 
                        type="text" 
                        id="title" 
                        wire:model="taksEdit.title"
                        class="mt-1 px-4 py-2 border border-gray-300 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    >
                    @error('taksEdit.title') <span class="error text-red-500 text-xs" >{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Estado</label>
                    <select 
                        id="status" 
                        wire:model="taksEdit.status"
                        class="mt-1 px-4 py-2 border border-gray-300 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="1">Pendiente</option>
                        <option value="2">Completada</option>
                    </select>
                    @error('taksEdit.status') <span class="error text-red-500 text-xs" >{{ $message }}</span> @enderror
                </div>    
                <div class="flex justify-end">
                    <button 
                        type="button" 
                        class="mr-2 bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition" 
                        wire:click="closeEdit">
                        Cancelar
                    </button>
                    <button 
                        type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Card para confirmar el delete -->
    <div x-data="{ show: @entangle('deleteOpen') }" x-show="show" x-cloak class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-80 sm:w-1/2 p-6">
            <h2 class="text-2xl font-bold mb-4">¿Esta seguro de eliminar esta tarea?</h2>
             <div class="text-2xl  mb-4">
                {{$title}}
             </div>
                <div class="flex justify-end">
                    <button 
                        type="button" 
                        class="mr-2 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition" 
                        wire:click="delete({{ $deleteTaskId }})">
                        Eliminar
                    </button>
                    <button 
                        type="submit" 
                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition"
                        wire:click="closeDelete">
                        Cancelar
                    </button>
                </div>
        </div>
    </div>

</div>