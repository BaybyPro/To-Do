<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ForgotPasswordForm extends Form
{

    #[Validate(['required','max:255','email'])]
    //hacemos la validación para que acepte solo en formato de email
    #[Validate('regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', message:'Formato invalido de correo electronico')]
    public $email;

    // Función para enviar el correo de recuperación de contraseña
    public function sendPasswordResetLink()
    {
        $this->validate();

        $status = Password::sendResetLink(
            ['email' => $this->email]  //correo a enviar el link del reset
        );

        // Verifica si el estado devuelto fue enviado con éxito.
        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('status', __($status));  //guarda el mensaje de exito para la vista
            $this->reset('email');                       // // Reinicia el valor del campo 'email'
        } else {
            $this->addError('email', __($status));
        }

    }

}
