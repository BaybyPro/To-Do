<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\ForgotPasswordForm;
use App\Livewire\Forms\LoginForm;
use App\Livewire\Forms\RegisterForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Livewire\Component;

class AuthForm extends Component
{
    public $view = 'login'; // Controla si se muestra login o register
    public RegisterForm $registerForm;
    public LoginForm $loginForm;
    public ForgotPasswordForm $forgotForm;
    public function switchView($view)
    {
        $this->view = $view;
    }

    //se cumple la función de RegisterForm para registrar usuarios
    public function register()
    {
       $this->registerForm->register();
    }

    //se cumple la función de LoginForm para el login de usuario
    public function login()
    {
        $this->loginForm->login();
    }

    //se cumple la función de ForgotPasswordForm para recuperar la contraseña
    public function recoverPassword()
    {
        $this->forgotForm->sendPasswordResetLink();
    }


    public function render()
    {
        return view('livewire.auth.auth-form');
    }
}
