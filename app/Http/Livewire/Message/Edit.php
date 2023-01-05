<?php

namespace App\Http\Livewire\Message;

use App\Models\Message;
use App\Models\Symbol;
use HackerESQ\Settings\Facades\Settings;
use Illuminate\Support\Facades\Blade;
use Livewire\Component;

class Edit extends Component
{
    public $Symbol;
    public $messageObject;
    public $messageText;
    public $flash_message;

    public $rules = [
        'messageObject.position' => ['required' , 'in:buy,sell'],
        'messageObject.entry' => ['nullable' , 'string', 'max:255'],
        'messageObject.target' => ['nullable' , 'string', 'max:255'],
        'messageObject.tp1' => ['nullable' , 'string', 'max:255'],
        'messageObject.tp2' => ['nullable' , 'string', 'max:255'],
        'messageObject.tp3' => ['nullable' , 'string', 'max:255'],
        'messageObject.stop' => ['nullable' , 'string', 'max:255'],
        'messageObject.description' => ['nullable' , 'string'],
    ];

    public function updated($peroperty , $value )
    {
        $this->flash_message = null;
        $this->validateOnly($peroperty);
        $this->messageText();
    }

    private function messageText() {
        $this->messageText = Blade::render(
            nl2br(str_replace( ['[[' , ']]'] , [ '{{$' , '}}'] , Settings::get('message')  )),
            [
                'CURRENCY_ICON' => $this->Symbol->icon,
                'CURRENCY_TITLE' => $this->Symbol->title,
                'CURRENCY_SYMBOL' => $this->Symbol->symbol,
                'POSITION_LABEL' => Settings::get($this->messageObject['position'] . '_label'),
                'POSITION_ICON' => Settings::get($this->messageObject['position'] . '_icon'),
                'TARGET' => $this->messageObject['target'],
                'ENTRY' => $this->messageObject['entry'],
                'TP1' => $this->messageObject['tp1'],
                'TP2' => $this->messageObject['tp2'],
                'TP3' => $this->messageObject['tp3'],
                'STOP' => $this->messageObject['stop'],
                'DESCRIPTION' => $this->messageObject['description'],
            ]
        );
    }

    public function save()
    {
        $this->validate();
        $this->messageText();
        $this->messageObject->message = $this->messageText;
        $this->messageObject->symbol_id = $this->Symbol->id;
        $this->messageObject->signature = Settings::get('message');
        $this->messageObject->save();
        $this->flash_message = "Saved successfully.";
    }


    public function mount(Symbol $symbol, Message $message)
    {
        $this->flash_message = null;
        $this->Symbol = $symbol;
        $this->messageObject = $message;
        $this->messageText();
    }
    public function render()
    {
        return view('livewire.message.edit')->layout('layouts.app');
    }
}
