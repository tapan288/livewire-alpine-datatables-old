<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class StudentsList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $sections = [];
    public $search = '';
    public $selectedClass = null, $selectedSection = null;

    public function render()
    {
        return view('livewire.students-list', [
            'students' => $this->studentsQuery->paginate($this->paginate),
            'classes' => \App\Models\Classes::all(),
        ]);
    }

    protected $listeners = [
        'deleteSingleRecord',
        'deleteMultipleRecords',
    ];

    public function updatedSelectedClass($value)
    {
        $this->sections = \App\Models\Section::where('class_id', $value)->get();
        $this->reset('selectedSection');
    }

    public function getStudentsQueryProperty()
    {
        return Student::with(['class', 'section'])
            ->search(trim($this->search))
            ->when($this->selectedClass, function ($query) {
                return $query->where('class_id', $this->selectedClass);
            })
            ->when($this->selectedSection, function ($query) {
                return $query->where('section_id', $this->selectedSection);
            });
    }

    public function deleteSingleRecord($id)
    {
        Student::find($id)->delete();
        session()->flash('message', 'Student deleted successfully.');
    }

    public function deleteMultipleRecords(array $checked)
    {
        Student::whereIn('id', $checked)->delete();
        session()->flash('message', 'Students deleted successfully.');
    }
}
