<div>
    <x-slot name="title">{{ 'Setting'}}</x-slot>
    @if($flash_message)
        <div class="alert alert-success">
            {{$flash_message}}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 row mb-3">
            <label for="token" class="col-md-4 col-form-label">Bot Token:</label>

            <div class="col-md-6">
                <input id="token" type="text" class="form-control @error('token') is-invalid @enderror" wire:model.lazy="token"  value="{{ $token }}" autocomplete="off" autofocus>
                 @error('token')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <a href="https://www.siteguarding.com/en/how-to-get-telegram-bot-api-token" class="text-secondary small" target="_blank">Help link</a>
        </div>
        <div class="col-md-6 row mb-3">
            <label for="channel_id" class="col-md-4 col-form-label">Channel Position Id:</label>

            <div class="col-md-6">
                <input id="channel_id" type="text" class="form-control @error('channel_id') is-invalid @enderror" wire:model.lazy="channel_id"  value="{{ $channel_id }}" autocomplete="off" autofocus>
                @error('channel_id')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <a href="https://www.alphr.com/find-chat-id-telegram/" class="text-secondary small" target="_blank">Help link</a>

        </div>
        <div class="col-md-6 row mb-3">
            <label for="buy_label" class="col-md-4 col-form-label">Buy Position label:</label>

            <div class="col-md-6">
                <input id="buy_label" type="text" class="form-control @error('buy_label') is-invalid @enderror" wire:model.lazy="buy_label"  value="{{ $buy_label }}" autocomplete="off" autofocus>
                @error('buy_label')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-6 row mb-3">
            <label for="sell_label" class="col-md-4 col-form-label">Sell Position label:</label>

            <div class="col-md-6">
                <input id="sell_label" type="text" class="form-control @error('sell_label') is-invalid @enderror" wire:model.lazy="sell_label"  value="{{ $sell_label }}" autocomplete="off" autofocus>
                @error('sell_label')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-6 row mb-3">
            <label for="buy_icon" class="col-md-4 col-form-label">Buy Position Icon:</label>

            <div class="col-md-6">
                <input id="buy_icon" type="text" class="form-control @error('buy_icon') is-invalid @enderror" wire:model.lazy="buy_icon"  value="{{ $buy_icon }}" autocomplete="off" autofocus>
                @error('buy_icon')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="text-secondary small">Use `Windows button + dot` for open emoji on windows</div>

        </div>
        <div class="col-md-6 row mb-3">
            <label for="sell_icon" class="col-md-4 col-form-label">Sell Position Icon:</label>

            <div class="col-md-6">
                <input id="sell_icon" type="text" class="form-control @error('sell_icon') is-invalid @enderror" wire:model.lazy="sell_icon"  value="{{ $sell_icon }}" autocomplete="off" autofocus>
                @error('sell_icon')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="text-secondary small">Use `Windows button + dot` for open emoji on windows</div>
        </div>

        <div class="col-md-12 row mb-3">
            <label for="message_text" class="col-md-2 col-form-label">Message template:</label>

            <div class="col-md-10">
                <textarea id="message_text" rows="6" class="form-control @error('message_text') is-invalid @enderror" wire:model.lazy="message_text" autocomplete="off" autofocus>{{ $message_text }}</textarea>
                <div class="text-secondary small">
                    Use `Windows button + dot` for open emoji on windows
                </div>
                <div class="text-secondary small">
                    You can use if condition like : &#64;if($Variable) .... &#64;endif
                </div>
                <div class="text-secondary small">
                    Use This Variable:
                </div>
                <span style="cursor: pointer;" class="text-info" wire:click.prevent="add('CURRENCY_ICON')">[[CURRENCY_ICON]]</span>
                <span style="cursor: pointer;" class="text-info" wire:click.prevent="add('CURRENCY_TITLE')">[[CURRENCY_TITLE]]</span>
                <span style="cursor: pointer;" class="text-info" wire:click.prevent="add('CURRENCY_SYMBOL')">[[CURRENCY_SYMBOL]]</span>
                <span style="cursor: pointer;" class="text-info" wire:click.prevent="add('POSITION_LABEL')">[[POSITION_LABEL]]</span>
                <span style="cursor: pointer;" class="text-info" wire:click.prevent="add('POSITION_ICON')">[[POSITION_ICON]]</span>
                <span style="cursor: pointer;" class="text-info" wire:click.prevent="add('ENTRY')">[[ENTRY]]</span>
                <span style="cursor: pointer;" class="text-info" wire:click.prevent="add('TARGET')">[[TARGET]]</span>
                <span style="cursor: pointer;" class="text-info" wire:click.prevent="add('TP1')">[[TP1]]</span>
                <span style="cursor: pointer;" class="text-info" wire:click.prevent="add('TP2')">[[TP2]]</span>
                <span style="cursor: pointer;" class="text-info" wire:click.prevent="add('TP3')">[[TP3]]</span>
                <span style="cursor: pointer;" class="text-info" wire:click.prevent="add('STOP')">[[STOP]]</span>
                <span style="cursor: pointer;" class="text-info" wire:click.prevent="add('DESCRIPTION')">[[DESCRIPTION]]</span>
                @error('message_text')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>




        <div class="col-md-12 mt-4 justify-content-center align-items-center d-flex border-1">
            <button type="button" class="btn btn-success mt-4" wire:loading.attr="disabled"
                    wire:click.prevent="save">
                Submit
            </button>
        </div>
    </div>
</div>
