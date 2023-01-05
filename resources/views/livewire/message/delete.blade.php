<div>

    <x-slot name="title">{{ 'Delete Message' }}</x-slot>
    <x-slot name="backRoute">{{ route('messages' , ['symbol' => $Symbol['id']] )}}</x-slot>
    @if($flash_message)
        <div class="alert alert-danger">
            {{$flash_message}}
        </div>
    @endif
    <div class="row">
        <div class="col-md-9">
            <div class=" mt-5 ">
                <strong>Created at: {{ $messageObject['created_at']  }}</strong>
            </div>
            <div class=" mt-2 mb-3">
                <strong>Updated at: {{ $messageObject['updated_at']  }}</strong>
            </div>
            <hr>
            <div class=" mt-5 ">
                <strong>Share Link: {{ \HackerESQ\Settings\Facades\Settings::get('channel_link') . $messageObject['telegram_id']  }}</strong>
            </div>
            <div class=" mt-2">
                <a href="{{ \HackerESQ\Settings\Facades\Settings::get('channel_link') . $messageObject['telegram_id']  }}" target="_blank">Show on Telegram</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="col-md-12 p-1" style="border: solid;border-radius: 9px;border-color: #00968878;background-color: #4caf5036;">
                {!! $messageObject['message'] !!}
            </div>
            <button type="button" class="btn btn-danger mt-4 w-100" wire:loading.attr="disabled"
                    wire:click.prevent="delete">
                🗑️️ Delete Message
            </button>
        </div>
    </div>
</div>
