<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     // Redirige al usuario a la página de inicio después de cerrar sesión
     public function logout()
     {
         Auth::logout();
         return redirect('/login');
     }
     
      
     
}
