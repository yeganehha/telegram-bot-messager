<?php

namespace App\Http\Livewire\Message;

use App\Models\Message;
use App\Models\Symbol;
use HackerESQ\Settings\Facades\Settings;
use Illuminate\Support\Facades\Blade;
use Livewire\Component;

use React\EventLoop\Factory;
use unreal4u\TelegramAPI\HttpClientRequestHandler;
use unreal4u\TelegramAPI\Telegram\Methods\EditMessageText;
use unreal4u\TelegramAPI\Telegram\Methods\SendMessage;
use unreal4u\TelegramAPI\TgLog;

class Edit extends Component
{
    public $Symbol;
    public $messageObject;
    public $messageText;
    public $flash_message;

    public $rules = [
        'messageObject.position' => ['required' , 'in:buy,sell,buy_limit,sell_limit'],
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

    private function messageText( $isNL2Br = true) {
        $text = str_replace( ['[[' , ']]'] , [ '{{$' , '}}'] , Settings::get('message')  ) ;
        if ( $isNL2Br )
            $text = nl2br($text);
        $html =  Blade::render($text,
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
        if ( $isNL2Br )
            $this->messageText = $html ;
        else
            return $html;
    }

    public function save()
    {
        $this->validate();
        $this->messageText();
        $this->messageObject->message = $this->messageText;
        $this->messageObject->symbol_id = $this->Symbol->id;
        $this->telegram();
        $this->messageObject->signature = Settings::get('message');
        $this->messageObject->save();
        $this->flash_message = "Message send or edit in telegram successfully.";
    }

    private function telegram()
    {
        $loop = Factory::create();
        $tgLog = new TgLog(Settings::get('token'), new HttpClientRequestHandler($loop));
        if ( $this->messageObject->telegram_id == null ) {
            $message = new SendMessage();
        } else {
            $message = new EditMessageText();
            $message->message_id = $this->messageObject->telegram_id ;
        }
        $message->chat_id = Settings::get('channel_id');
        $message->text = $this->messageText(false);
        $promise = $tgLog->performApiRequest($message);
        $promise->then(
            function ($response) {
                $this->messageObject->telegram_id =  $response->message_id ;
            },
            function (\Exception $exception) {
            }
        );
        $loop->run();
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
