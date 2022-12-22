<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentsExport implements FromQuery
{
    use Exportable;
    public $students;

    public function __construct(array $students)
    {
        $this->students = $students;
    }

    public function query()
    {
        return Student::whereKey($this->students);
    }
}
