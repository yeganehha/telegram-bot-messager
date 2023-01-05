<?php

namespace App\Http\Livewire\Message;

use App\Models\Message;
use App\Models\Symbol;
use HackerESQ\Settings\Facades\Settings;
use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use React\EventLoop\Factory;
use unreal4u\TelegramAPI\HttpClientRequestHandler;
use unreal4u\TelegramAPI\Telegram\Methods\DeleteMessage;
use unreal4u\TelegramAPI\Telegram\Methods\EditMessageText;
use unreal4u\TelegramAPI\Telegram\Methods\SendMessage;
use unreal4u\TelegramAPI\TgLog;

class Delete extends Component
{
    public $Symbol;
    public $messageObject;
    public $messageText;
    public $canDelete = true;
    public $flash_message;

    public function delete()
    {
        $this->canDelete = true;
        $this->telegram();
        if ( $this->canDelete ) {
            $this->messageObject->delete();
            $this->redirect( route('messages' , ['symbol' => $this->Symbol['id']] ) );
        } else
            $this->flash_message = "Telegram Can not delete this message!";
    }

    private function telegram()
    {
        $loop = Factory::create();
        $tgLog = new TgLog(Settings::get('token'), new HttpClientRequestHandler($loop));
        $message = new DeleteMessage();
        $message->message_id = $this->messageObject->telegram_id ;
        $message->chat_id = Settings::get('channel_id');
        $promise = $tgLog->performApiRequest($message);
        $promise->then(
            function ($response) {
                $this->canDelete = true;
            },
            function (\Exception $exception) {
                $this->canDelete = false;
            }
        );
        $loop->run();
    }

    public function mount(Symbol $symbol, Message $message)
    {
        $this->flash_message = null;
        $this->Symbol = $symbol;
        $this->messageObject = $message;
    }
    public function render()
    {
        return view('livewire.message.delete');
    }
}
