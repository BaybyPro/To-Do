<?php

namespace App\Livewire;

use App\Livewire\Forms\TaskFormCreate;
use App\Livewire\Forms\TaskFormEdit;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TasksPost extends Component
{
    public $tasks;
    public TaskFormCreate $taksCreate;
    public TaskFormEdit $taksEdit;
    public $editOpen = false;
    public $deleteOpen = false;
    public $deleteTaskId;
    public $title;
    public $date = '';
    public $filterStatus = '';
    public $filterTitle = '';
    
    public function mount()
    {
        
        $this->loadTasks();
    }

    // Obtener las tareas del usuario
    public function loadTasks()
    {
        $userId = Auth::id();
        // Obtenemos solo las tareas del usuario autentificado
        $task = Task::where('user_id', $userId)
                    ->orderBy('id','desc');
                    $this->tasks = $task->get();
        // Filtro de estado pendiente(1) completada(2)
        if ($this->filterStatus !== '') {
            $task->where('status', $this->filterStatus);
        }
        // Filtro de por fecha
        if ($this->date) {
            $task->whereDate('date', $this->date);
        }
        // Filtro de por titulo
        if ($this->filterTitle !== ''){
            $task->where('title', 'like', '%' . $this->filterTitle . '%');
        }

        $this->tasks = $task->get();
    }

    // // GUARDAR

    //se guarda las tareas usando la function de TaskFormCreate
    public function save()
    {
        $this->taksCreate->save();
        $this->loadTasks(); 
    }

     // // ACTUALIZAR / EDITAR

    //se actuliza solo la tarea como completado (2) sin afectar a las demas
    public function check($taskId)
    {
        $checkTask = Task::find($taskId);
        
        $checkTask->update([
           'status' => '2'
        ]);
        $this->loadTasks();
    }


    //función para abrir el edit y enviar los datos del task a editar
    public function edit($taskId, $status)
    {
        $this->editOpen = true;
        $this->taksEdit->edit($taskId, $status);
    }

    public function closeEdit()
    {
        $this->editOpen = false;
    }

     // aquí actulizamos el taks con los datos del formulario sin afectar las demas tareas
    public function updateTask()
    {
        $updatedTask = $this->taksEdit->update();
        $this->loadTasks();
        $this->editOpen = false;
    }

    

    // // ELIMINAR

    //Aquí controlamos la eliminación de tareas

    public function confirmDelete($taskId, $titled)
    {
        $this->deleteTaskId = $taskId; 
        $this->title = $titled;
        $this->deleteOpen = true; 
    }

    public function closeDelete(){
        $this->deleteOpen = false;
    }
    public function delete($taskId)
    {
        $task = Task::find($taskId);

        if ($task) {
            $task->delete();

            $this->loadTasks();
        }

        $this->deleteOpen = false;
    }

    // // FILTROS

    //actualizar tareas por filtro de status del select filterStatus
    public function filterByStatus($status)
    {   
        $this->filterStatus = $status;
        $this->loadTasks();  
    }

    //actualizar tareas por fecha de status del input date
    public function filterByDate($date)
    {
        $this->date = $date;
        $this->loadTasks();
    }

    //actualizar tareas cuando se detecte cada letra escriba en el input filterTitle
    public function updatedfilterTitle()
    {
     $this->loadTasks();
    }

    //Reiniciamos todos los filtros
    public function resetAllFilters(): void
    {
        $this->filterTitle = '';
        $this->filterStatus = '';
        $this->date = null;
        $this->loadTasks();
    }

    public function render()
    {

        return view('livewire.tasks-post');
    }
}
