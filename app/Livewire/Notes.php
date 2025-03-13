<?php

namespace App\Livewire;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Notes extends Component
{
    public $user;
    public $classroom;
    public $students;

    public $grades = [];

    public function mount()
    {
        $this->user = Auth::user();

        $this->classroom = $this->user->classrooms;
        foreach ($this->classroom->students as $student) {
            $this->grades[$student->id] = '';
        }

        $this->students = $this->classroom->students;
    }

    public function submitGrades()
    {
        foreach ($this->grades as $studentId => $grade) {
            $student = User::find($studentId);
            if ($student) {
                $student->last_grade = (int) $grade;
                $student->average = $this->calculateAverage($student);
                $student->save();
            }
        }

        session()->flash('message', 'Grades submitted successfully.');
    }

    private function calculateAverage($student)
    {
        return ($student->last_grade + $student->average) / 2;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.notes');
    }
}
