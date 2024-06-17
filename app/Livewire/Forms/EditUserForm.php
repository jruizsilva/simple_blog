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
            'required',
            'array',
            'min:1'
        ]
    ])]
    public $roles;
    public $name;

    public function edit(User $user)
    {
        $this->resetValidation();
        $this->open = true;
        $this->roles = $user->roles()->pluck('id')->toArray();
        $this->name = $user->name;
    }

    public function update()
    {
        $this->validate();
    }
}
