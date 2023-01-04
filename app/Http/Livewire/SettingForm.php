<?php

namespace App\Http\Livewire;

use HackerESQ\Settings\Facades\Settings;
use Livewire\Component;

class SettingForm extends Component
{

    public $token;
    public $flash_message;
    public $message_text;
    public $channel_id;
    public $buy_label;
    public $sell_label;

    public $rules = [
        'token' => ['required' , 'string'],
        'channel_id' => ['required' , 'numeric'],
        'message_text' => ['required' , 'string'],
        'buy_label' => ['nullable' , 'string'],
        'sell_label' => ['nullable' , 'string'],
    ];

    public function updated($peroperty , $value )
    {
        $this->flash_message = null;
        $this->validateOnly($peroperty);
    }


    public function save()
    {
        $this->validate();
        Settings::force()->set([
            'token' => $this->token ,
            'channel_id' => $this->channel_id ,
            'message' => $this->message_text ,
            'buy_label' => $this->buy_label ,
            'sell_label' => $this->sell_label ,
            ]);
        $this->flash_message = "Saved successfully.";
    }
    public function add($value)
    {
        $this->message_text = $this->message_text ." [[".  strtoupper($value) . "]] ";
        $this->flash_message = null;
    }

    public function mount()
    {
        $this->flash_message = null;
        $this->token = Settings::get('token');
        $this->channel_id = Settings::get('channel_id');
        $this->message_text = Settings::get('message');
        $this->buy_label = Settings::get('buy_label' , '🟢');
        $this->sell_label = Settings::get('sell_label' , '🔴');
    }
    public function render()
    {
        return view('livewire.setting-form')->layout('layouts.app');
    }
}
