<div>
    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm shadow-lg">
            <img class="mx-auto h-10 w-auto" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/67/Microsoft_To-Do_icon.png/735px-Microsoft_To-Do_icon.png" alt="logo form">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Restablecer contraseña</h2>
        </div>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm shadow-lg">
            {{-- formulario para restablecer la contraseña --}}
            <form wire:submit.prevent="senPassword" class="space-y-6">
                <input type="hidden" wire:model="resetPassword.token">

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-700">Correo electrónico</label>
                    <input 
                     type="email" 
                     id="email" 
                     wire:model.defer="resetPassword.email" {{-- modelo para el resetPassword --}}
                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('resetPassword.email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-700">Nueva contraseña</label>
                    <input 
                    type="password" 
                    id="password" 
                    wire:model.defer="resetPassword.password"  {{-- modelo para el resetPassword --}}
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    >
                    @error('resetPassword.password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-700">Confirmar nueva contraseña</label>
                    <input 
                    type="password" 
                    id="password_confirmation" 
                    wire:model.defer="resetPassword.password_confirmation"  {{-- modelo para el resetPassword --}}
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    >
                </div>

                <div>
                    <button 
                    type="submit"
                    class="w-full justify-center rounded-md bg-teal-900 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-teal-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-teal-600">
                        Restablecer contraseña
                    </button>
                </div>
            </form>
            
            <div class="mt-4">
                <button 
                wire:click="testAction"
                class="w-full justify-center rounded-md bg-blue-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                    Botón de prueba
                </button>
            </div>
        </div>
    </div>
</div>