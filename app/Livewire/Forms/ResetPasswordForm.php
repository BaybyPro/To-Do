<?php

namespace App\Livewire\Forms;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;

class ResetPasswordForm extends Form
{
    public $token;

     //valida que el sea un email registrado
    #[Validate(['required','email','exists:users,email'])]
    public $email = '';

    #[Validate(['required','string','confirmed','min:8','regex:/^(?=.*[A-Z])(?=.*\d).+$/'])]
    //hacemos la validación para que acepte si tiene una mayúscula y un número
    #[Validate('regex:/^(?=.*[A-Z])(?=.*\d).+$/', message:'Debe tener una mayúscula y un número')]
    public $password = '';

    public $password_confirmation = '';

    public function resetPassword()
    {
        

        $status = Password::reset(
            //creadenciales del usuario que desea restablecer
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token, //token recibido por el http
            ],
            // Lógica para actualizar la contraseña del usuario.
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password) // Hash de la nueva contraseña.
                ])->setRememberToken(Str::random(60)); // Genera un nuevo token para la sessión

                $user->save();

                // Dispara el evento de restablecimiento de contraseña.
                event(new PasswordReset($user));
            }
        );
        // Verifica si el estado indica que la contraseña fue restablecida con éxito.
        if ($status === Password::PASSWORD_RESET) {
            session()->flash('status', __($status)); //se guarda mensaje de exito
            return redirect()->route('login');  //redirecciona la ruta /login
        } else {
            // Si hubo un error, se agrega un mensaje de error al campo 'email'.
            $this->addError('email', __($status));
        }
    }
}