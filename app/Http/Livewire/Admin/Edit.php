<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $user;
    public $password;
    public $flash_message;

    public $rules = [
        'user.name' => ['required' , 'string', 'max:255'],
        'user.email' => ['required' , 'string', 'email', 'max:255' , 'unique:users,email'],
        //'user.password' => ['required' , 'string', 'min:8'],
    ];

    public function updated($peroperty , $value )
    {
        $this->rules['user.email'] = ['required' , 'string', 'email', 'max:255' , 'unique:users,email,' .$this->user->id ];
        $this->flash_message = null;
        $this->validateOnly($peroperty);
        $this->rules['user.email'] = ['required' , 'string', 'email', 'max:255' , 'unique:users,email'];

    }


    public function save()
    {
        $this->rules['user.email'] = ['required' , 'string', 'email', 'max:255' , 'unique:users,email,' .$this->user->id ];
        $this->validate();
        //$this->user->password = bcrypt( $this->user->password);
        $this->user->save();
        $this->rules['user.email'] = ['required' , 'string', 'email', 'max:255' , 'unique:users,email'];
        $this->flash_message = "Saved successfully.";
    }


    public function mount(User $id)
    {
        $this->flash_message = null;
        $this->user = $id;
        $this->password = $this->user->password ;
    }
    public function render()
    {
        return view('livewire.admin.edit')->layout('layouts.app');
    }
}
