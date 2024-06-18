<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditUserForm extends Form
{
    public $open;
    #[Validate([
        'roles' => [
            'array',
        ]
    ])]
    public $roles;
    public $name;
    public $userId;

    public function edit(User $user)
    {
        $this->resetValidation();
        $this->open = true;
        $this->roles = $user->roles()->pluck('id')->toArray();
        $this->name = $user->name;
        $this->userId = $user->id;
    }

    public function update()
    {
        $this->validate();
        $user = User::find($this->userId);
        $user->roles()->sync($this->roles);
        $this->reset();
    }
}
