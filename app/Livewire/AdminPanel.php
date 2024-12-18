<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;


class AdminPanel extends Component
{
    public $user;
    public $users;
    public $classrooms;
    public $students;
    public $teachers;

    public $new_name;
    public $new_email;
    public $new_classroom;

    public function mount()
    {
        $this->user = Auth::user()
            ->load('classrooms');
        $this->users = User::with('classrooms')->get();
        $this->classrooms = Auth::user()
            ->classrooms
            ->load('students');
        $this->students = User::role('student')->get();
        $this->teachers = User::role('teacher')->get();
    }

    public function deleteStudent(User $student)
    {
        sleep(3);
        $student->delete();
    }

    public function CreateStudent()
    {
        sleep(3);
        User::factory()->create([
            'name' => $this->new_name,
            'email' => $this->new_email,
            'classroom_id' => $this->new_classroom,
            'password' => 'securedPasswordXD',
        ]);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin-panel');
    }
}
