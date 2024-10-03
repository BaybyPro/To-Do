<?php

namespace App\Livewire;

use App\Livewire\Forms\ResetPasswordForm;
use Livewire\Component;

class ResetPassword extends Component
{
    public $token;
    public ResetPasswordForm $resetPassword;

    //Se obtiene el token del http y se envia al ResetPasswordForm
    public function mount($token)
    {
        $this->token = $token;
        $this->resetPassword->token = $token;
    }

    //Se restablece la contraseña con la función del ResetPasswordForm
    public function senPassword()
    {
        $this->resetPassword->resetPassword();
    }


    public function render()
    {
        return view('livewire.reset-password');
    }
}