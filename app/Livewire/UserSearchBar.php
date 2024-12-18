<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UserSearchBar extends Component
{
    public Collection $users;
    public Collection $searchResults;
    public string $searchText = '';
    public bool $toggleResults = false;


    public function mount()
    {
        $this->searchResults = new Collection();
    }

    public function updatedSearchText()
    {
        if($this->searchText === '') {
            $this->searchResults = new Collection();
            $this->toggleResults = false;
            return;
        }
        $this->toggleResults = true;
        $this->searchResults = $this->users->filter(function ($student) {
            return str_contains(strtolower($student->name), strtolower($this->searchText));
        });
    }

    public function selectUser($name)
    {
        $this->toggleResults = false;
        $this->searchText = $name;
        $this->searchResults = new Collection();
    }

    public function selectFirst()
    {
        $this->searchText = $this->searchResults->first()->name;
        $this->toggleResults = false;
        $this->searchResults = new Collection();
    }

    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.user-search-bar');
    }
}
