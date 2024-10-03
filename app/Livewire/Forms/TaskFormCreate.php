<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskFormCreate extends Form
{
    #[Validate(['required','min:3','max:50'])]
    public $title;


    //función para crear tareas
    public function save(){

        $this->validate();

        //primero obtenemos el id del usuario autentificado

        $userId = Auth::id();

        //Guardamos en la base de datos con los datos proporciados en task-post.blade
        $newTask = Task::create([
            "title"=> $this->title,
            "user_id" => $userId,
        ]);

        $this->reset();
    }
}
