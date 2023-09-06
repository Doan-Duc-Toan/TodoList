<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Todo;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class TodoList extends Component
{
    use WithPagination;
    #[Rule('required|string')]
    public $name;
    public $search = '';
    public $editId;
    // #[Rule('required|string')]
    public $editName;
    public function store()
    {
        $this->validate();
        Todo::create([
            'name' => $this->name,
            'checked' => 0
        ]);
        $this->reset('name', 'search', 'editName', 'editId');
        //   $this->reset('completed');
        session()->flash('message', 'Created');
        $this->resetPage();

    }
    public function toggle($id)
    {
        $todo = Todo::find($id);
        $check = $todo->checked;
        $check ? $todo->checked = 0 : $todo->checked = 1;
        $todo->save();
    }
    public function edit($id)
    {
        $this->editId = $id;
        $this->editName = Todo::find($id)->name;
    }
    public function delete($id){
        Todo::find($id)->delete();
    }
    public function update()
    {
        $this->validate(['editName' => 'required|string']);
        Todo::find($this->editId)->update([
            'name' => $this->editName
        ]);
        $this->reset('name', 'search', 'editName', 'editId');
    }
    public function cancel(){
        $this->reset('name', 'search', 'editName', 'editId');
    }
   
    public function render()
    {
        $todos = Todo::where('name', 'like', "%{$this->search}%")->orderBy('created_at', 'desc')->paginate(5);
        return view('livewire.todo-list', [
            'todos' => $todos
        ]);
    }
}
