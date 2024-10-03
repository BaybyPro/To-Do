<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskFormEdit extends Form
{
   //primero validamos los datos usando el validate de livewire arriba las validaciones y abajo los datos que les les dará las reglas
     public $taskId;

     #[Validate(['required','min:3','max:50'])]
     public $title;

     #[Validate(['required','in:1,2'])]
     public $status;

     // Se obtiene el Id y estado del taks selecionado para editar 
     public function edit($taskId, $status)
     {
        $this->taskId = $taskId; //id que será poporciado en el componente

        $task = Task::find($taskId);

        $this->title = $task->title;  //titulo que será porporcinado en el componente
        $this->status = $status;
     }

     // Se actualiza con los nuevos datos validos
     public function update()
     {
        $this->validate();

        $task = Task::find($this->taskId);

        $task->update([
            'title' => $this->title,
            'status' => $this->status
        ]);
        //devolvemos el taks actulizado para controlar el cambio en la vista
        return $task;
     }
}