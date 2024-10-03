<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    //primero validamos los datos usando el validate de livewire arriba las validaciones y abajo los datos que les les dará las reglas

    // Para el registro
    #[Validate(['required','min:5','max:255'])]
    public $name ;
    #[Validate(['required','max:255','email','unique:users,email'])]
    //hacemos la validación para que acepte solo en formato de email
    #[Validate('regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', message:'Formato invalido de correo electronico')]
    public $email ;
    #[Validate(['required','string','confirmed','min:8','regex:/^(?=.*[A-Z])(?=.*\d).+$/'])]
    //hacemos la validación para que acepte si tiene una mayúscula y un número
    #[Validate('regex:/^(?=.*[A-Z])(?=.*\d).+$/', message:'Debe tener una mayúscula y un número')]
    public $password ;

    public $password_confirmation;

   

    //función para registrar un usuario
    public function register(){
        $this->validate();

        $newUser = User::create([
            'name'=> $this->name,
            'email'=> $this->email,
            'password'=> Hash::make($this->password),

        ]);

        // Iniciar sesión automáticamente
        Auth::login($newUser);

        // Redirigir a una página protegida después del registro
        return redirect()->route('tasks');
    }
}
