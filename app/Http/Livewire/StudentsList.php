<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class StudentsList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;

    public function render()
    {
        return view('livewire.students-list', [
            'students' => \App\Models\Student::with('class', 'section')->paginate($this->paginate),
        ]);
    }
}
