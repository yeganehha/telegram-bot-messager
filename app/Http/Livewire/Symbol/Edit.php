<?php

namespace App\Http\Livewire\Symbol;

use App\Models\Symbol;
use Livewire\Component;

class Edit extends Component
{
    public $Symbol;
    public $flash_message;

    public $rules = [
        'Symbol.title' => ['required' , 'string', 'max:255'],
        'Symbol.symbol' => ['nullable' , 'string', 'max:255'],
    ];

    public function updated($peroperty , $value )
    {
        $this->flash_message = null;
        $this->validateOnly($peroperty);
    }


    public function save()
    {
        $this->validate();
        $this->Symbol->save();
        $this->flash_message = "Saved successfully.";
    }


    public function mount(Symbol $id)
    {
        $this->flash_message = null;
        $this->Symbol = $id;
    }
    public function render()
    {
        return view('livewire.symbol.edit')->layout('layouts.app');
    }
}
