<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    //primero validamos los datos usando el validate de livewire arriba las validaciones y abajo los datos que les les dará las reglas

    #[Validate(['required','email'])]
    public $email;
    #[Validate(['required'])]
    public $password;

    //función para el login del usuario
    public function login(){
        $this->validate();  

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) //si los datos son correctos procede a envir a la vista de tareas
        {
            return redirect()->route('tasks');
        } else {
            session()->flash('error', 'Correo o contraseña invalidos');  //Si los datos son incorrectos se manda este mensaje
        }
    }
}
