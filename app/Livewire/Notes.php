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

    public function mount()
    {
        $this->user = Auth::user();

        $this->classroom = $this->user->classrooms;

        $this->students = User::role('student')->get();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.notes');
    }
}
