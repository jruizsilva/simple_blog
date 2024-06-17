<?php

namespace App\Livewire;

use App\Livewire\Forms\EditUserForm;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use WithPagination;

    public $search;
    public EditUserForm $editUser;
    public $roles;

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function edit(User $user)
    {
        $this->editUser->edit($user);
    }

    public function update()
    {
        $this->editUser->update();
    }

    public function render()
    {
        $users = User::orderBy('id', 'desc')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->paginate(10);
        $data = [
            'users' => $users,
        ];

        return view('livewire.users', $data);
    }
}
