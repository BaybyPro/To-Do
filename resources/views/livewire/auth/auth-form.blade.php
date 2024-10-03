<div class="flex  flex-col justify-center px-6 py-24 lg:px-8">

    <div class="sm:mx-auto sm:w-full sm:max-w-sm shadow-lg">
        <img class="mx-auto h-10 w-auto" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/67/Microsoft_To-Do_icon.png/735px-Microsoft_To-Do_icon.png" alt="logo form">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Ingrese su cuenta</h2>
    </div>
    
    {{-- Formulario para el login cuando el view esta en login  --}}
    @if ($view === 'login')
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm shadow-lg">
            @if (session()->has('error'))
                <div class="alert alert-danger text-red-300">{{ session('error') }}</div>
            @endif
            <form wire:submit.prevent="login" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-700">Email</label>
                    <input  id="email" wire:model="loginForm.email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('loginForm.email') <span class="error text-red-500 text-xs" >{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-700">Password</label>
                    <input type="password" id="loginPassword" wire:model="loginForm.password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('loginForm.password') <span class="error text-red-500 text-xs" >{{ $message }}</span> @enderror
                </div>
                <div class="font-serif underline underline-offset-1 text-xs text-gray-600 ml-2">
                   <span wire:click="switchView('recoverPassword')" class="cursor-pointer">Recuperar contraseña</span>
                </div>
                <button type="submit" class="w-full justify-center rounded-md bg-teal-900 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-teal-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-teal-600">
                    Ingresar</button>
            </form>
            <button wire:click="switchView('register')" class="my-5 w-full justify-center rounded-md bg-blue-800 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-teal-600">
                Registrarse
            </button>
        </div>
    {{-- Formulario para el login cuando el view esta en register  --}}
    @elseif ($view === 'register')
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm shadow-lg">
            <form wire:submit.prevent="register" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-700">Name</label>
                    <input type="text" id="name" wire:model="registerForm.name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('registerForm.name') <span class="error text-red-500 text-xs" >{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-700">Email</label>
                    <input  id="email" wire:model="registerForm.email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('registerForm.email') <span class="error text-red-500 text-xs" >{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-700">Password</label>
                    <input type="password" id="password" wire:model="registerForm.password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('registerForm.password') <span class="error text-red-500 text-xs" >{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-700">Confirm Password</label>
                    <input type="password" id="password_confirmation" wire:model="registerForm.password_confirmation" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                <button type="submit" class="w-full justify-center rounded-md bg-teal-900 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-teal-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-teal-600">
                    Register
                </button>
            </form>
            <button wire:click="switchView('login')" class="my-5 w-full justify-center rounded-md bg-blue-800 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-teal-600">
                regresar
            </button>
        </div>
     {{-- Formulario para recuperar la contraseña cuando el view esta en recoverPassword  --}}
     @elseif ($view === 'recoverPassword')
                    @if (session()->has('status'))
                            <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-sm">
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                    <span class="block sm:inline">{{ session('status') }}</span>
                                </div>
                            </div>
                        @endif
            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm shadow-lg">
                <form wire:submit.prevent="recoverPassword" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-700 my-5">
                            Ingrese su email para recuperar su contraseña</label>
                        <input  id="email" 
                            wire:model="forgotForm.email" 
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('forgotForm.email') <span class="error text-red-500 text-xs" >{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="w-full justify-center rounded-md bg-teal-900 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-teal-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-teal-600">
                        Enviar
                    </button>
                </form>
                <button wire:click="switchView('login')" class="my-5 w-full justify-center rounded-md bg-blue-800 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-teal-600">
                    regresar
                </button>
            </div>
        
      @endif
</div>
