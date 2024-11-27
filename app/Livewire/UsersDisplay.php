<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;


class UsersDisplay extends Component
{
    public $user;
    public $users;
    public $classrooms;

    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.users-display');
    }

    public function mount()
    {
        $this->user = Auth::user()
            ->load('classrooms');
        $this->users = User::with('classrooms')->get();
        $this->classrooms = Auth::user()
            ->classrooms
            ->load('students');
    }

    public function deleteStudent(User $student)
    {
        sleep(3);
        $student->delete();
    }
    
}
