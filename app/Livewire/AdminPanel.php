<?php

namespace App\Livewire;

use App\Models\Classroom;
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

    public $new_label;
    public $new_teacher;

    public $new_name;
    public $new_email;
    public $new_password;

    protected $listeners = ['userSelected' => 'selectUser'];
    public $selectedUser;
    public $selectedStudent;
    public $selectedClassroom;

    public function mount()
    {
        $this->user = Auth::user();

        if ($this->user->is_admin == 0)
        {
            return $this->redirect()->route('Dashboard');
        }
        $this->classrooms = Classroom::all()
            ->load('students');

        $this->students = User::role('student')->get();
        $this->teachers = User::role('teacher')->get();
    }

    public function selectUser($name)
    {
        $this->selectedUser = User::role('student')->where('name', $name)->first();
    }

    public function addStudentToClass($studentId, $classroom_id)
    {
        $student = User::role('student')
            ->where('id', $studentId)
            ->first()
            ->classroom_id = $classroom_id;
        $student->save();
    }

    public function removeStudentFromClass($student)
    {
        $student = User::role('student')
            ->where('name', $student['name'])
            ->first();
        $student->classroom_id = null;
        $student->save();
    }

    public function deleteStudent(User $student)
    {
        try
        {
            sleep(1);
            $this->students->remove($student);
            $student->delete();
            $this->selectedUser = null;
        }
        catch (\Exception $e)
        {
            return;
        }
    }

    public function createStudent()
    {
        sleep(1);
        $student = User::factory()->student()->create([
            'name' => $this->new_name,
            'email' => $this->new_email,
            'classroom_id' => null,
            'password' => $this->new_password,
        ]);

        $this->students->add($student);
    }

    public function deleteTeacher(User $teacher)
    {
        try
        {
            sleep(1);
            $teacher->delete();
            unset($this->selectedUser);
        }
        catch (\Exception $e)
        {
            return;
        }
    }

    public function createTeacher()
    {
        sleep(1);
        $teacher = User::factory()->teacher()->create([
            'name' => $this->new_name,
            'email' => $this->new_email,
            'password' => $this->new_password,
        ]);

        $this->teachers->add($teacher);
    }

    public function createClassroom()
    {
        sleep(1);
        $classroom = Classroom::create([
            'label' => $this->new_label,
            'id_teacher' => $this->new_teacher,
        ]);

        $this->classrooms->add($classroom);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin-panel');
    }
}
