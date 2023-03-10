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
    public $buy_icon;
    public $sell_icon;
    public $buy_limit_label;
    public $sell_limit_label;
    public $buy_limit_icon;
    public $sell_limit_icon;

    public $rules = [
        'token' => ['required' , 'string'],
        'channel_id' => ['required' , 'numeric'],
        'message_text' => ['required' , 'string'],
        'buy_label' => ['nullable' , 'string'],
        'sell_label' => ['nullable' , 'string'],
        'buy_icon' => ['nullable' , 'string'],
        'sell_icon' => ['nullable' , 'string'],
        'buy_limit_label' => ['nullable' , 'string'],
        'sell_limit_label' => ['nullable' , 'string'],
        'buy_limit_icon' => ['nullable' , 'string'],
        'sell_limit_icon' => ['nullable' , 'string'],
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
            'channel_link' => 'https://t.me/c/'. str_replace('-100' , '' , $this->channel_id).'/'  ,
            'message' => $this->message_text ,
            'buy_label' => $this->buy_label ,
            'sell_label' => $this->sell_label ,
            'buy_icon' => $this->buy_icon ,
            'sell_icon' => $this->sell_icon ,
            'buy_limit_label' => $this->buy_limit_label ,
            'sell_limit_label' => $this->sell_limit_label ,
            'buy_limit_icon' => $this->buy_limit_icon ,
            'sell_limit_icon' => $this->sell_limit_icon ,
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
        $this->buy_label = Settings::get('buy_label' , 'Buy');
        $this->sell_label = Settings::get('sell_label' , 'Sell');
        $this->buy_icon = Settings::get('buy_icon' , '????');
        $this->sell_icon = Settings::get('sell_icon' , '????');
        $this->buy_limit_label = Settings::get('buy_limit_label' , 'Buy Limit');
        $this->sell_limit_label = Settings::get('sell_limit_label' , 'Sell Limit');
        $this->buy_limit_icon = Settings::get('buy_limit_icon' , '????');
        $this->sell_limit_icon = Settings::get('sell_limit_icon' , '????');
    }
    public function render()
    {
        return view('livewire.setting-form')->layout('layouts.app');
    }
}
