<div>

    <x-slot name="title">{{ 'Send / Edit Message for '.$Symbol['title'] }}</x-slot>
    <x-slot name="backRoute">{{ route('messages' , ['symbol' => $Symbol['id']] )}}</x-slot>
    @if($flash_message)
        <div class="alert alert-success">
            {{$flash_message}}
        </div>
    @endif
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="entry" class="col-form-label">💲 Entry price:</label>
                    <input id="entry" type="text" class="form-control @error('messageObject.entry') is-invalid @enderror" wire:model.lazy="messageObject.entry"  value="{{ $messageObject['entry'] }}" autocomplete="off" autofocus>
                    @error('messageObject.entry')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="target" class="col-form-label">🎯 Target:</label>
                    <input id="target" type="text" class="form-control @error('messageObject.target') is-invalid @enderror" wire:model.lazy="messageObject.target"  value="{{ $messageObject['target'] }}" autocomplete="off" autofocus>
                    @error('messageObject.target')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="stop" class="col-form-label">⛔ Stop-loss:</label>
                    <input id="stop" type="text" class="form-control @error('messageObject.stop') is-invalid @enderror" wire:model.lazy="messageObject.stop"  value="{{ $messageObject['stop'] }}" autocomplete="off" autofocus>
                    @error('messageObject.stop')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="tp1" class="col-form-label">Tp1:</label>
                    <input id="tp1" type="text" class="form-control @error('messageObject.tp1') is-invalid @enderror" wire:model.lazy="messageObject.tp1"  value="{{ $messageObject['tp1'] }}" autocomplete="off" autofocus>
                    @error('messageObject.tp1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tp2" class="col-form-label">Tp2:</label>
                    <input id="tp2" type="text" class="form-control @error('messageObject.tp2') is-invalid @enderror" wire:model.lazy="messageObject.tp2"  value="{{ $messageObject['tp2'] }}" autocomplete="off" autofocus>
                    @error('messageObject.tp2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tp3" class="col-form-label">Tp3:</label>
                    <input id="tp3" type="text" class="form-control @error('messageObject.tp3') is-invalid @enderror" wire:model.lazy="messageObject.tp3"  value="{{ $messageObject['tp3'] }}" autocomplete="off" autofocus>
                    @error('messageObject.tp3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="position" class="col-form-label">Position:</label>
                    <select id="position" class="form-control @error('messageObject.position') is-invalid @enderror" wire:model.lazy="messageObject.position"  >
                        <option >Select One Item</option>
                        <option value="sell" @selected($messageObject['position'] == "sell" ) >{{ \HackerESQ\Settings\Facades\Settings::get("sell_label") }}</option>
                        <option value="sell_limit" @selected($messageObject['position'] == "sell_limit" ) >{{ \HackerESQ\Settings\Facades\Settings::get("sell_limit_label") }}</option>
                        <option value="buy" @selected($messageObject['position'] == "buy" ) >{{ \HackerESQ\Settings\Facades\Settings::get("buy_label") }}</option>
                        <option value="buy_limit" @selected($messageObject['position'] == "buy_limit" ) >{{ \HackerESQ\Settings\Facades\Settings::get("buy_limit_label") }}</option>
                    </select>
                    @error('messageObject.position')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-8 mb-3">
                    <label for="description" class="col-form-label">Description:</label>
                    <textarea id="description" rows="6"  class="form-control @error('messageObject.description') is-invalid @enderror" wire:model.lazy="messageObject.description"  autocomplete="off" autofocus>{{ $messageObject['description'] }}</textarea>
                    @error('messageObject.description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="col-md-12 p-1" style="border: solid;border-radius: 9px;border-color: #00968878;background-color: #4caf5036;">
                {!! $messageText !!}
            </div>
            <button type="button" class="btn btn-success mt-4 w-100" wire:loading.attr="disabled"
                    wire:click.prevent="save">
                🗨️ Send (edit) Message
            </button>
        </div>
    </div>
</div>
