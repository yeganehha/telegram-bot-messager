<div>
    <x-slot name="title">{{ 'Edit/Add Currency'}}</x-slot>
    <x-slot name="backRoute">{{ route('currency')}}</x-slot>
    @if($flash_message)
        <div class="alert alert-success">
            {{$flash_message}}
        </div>
    @endif
    <div class="row">


        <div class="col-md-6 row mb-3">
            <label for="title" class="col-md-4 col-form-label">Title:</label>

            <div class="col-md-6">
                <input id="title" type="text" class="form-control @error('Symbol.title') is-invalid @enderror" wire:model.lazy="Symbol.title"  value="{{ $Symbol['title'] }}" autocomplete="off" autofocus>
                @error('Symbol.title')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>

        <div class="col-md-6 row mb-3">
            <label for="symbol" class="col-md-4 col-form-label">symbol:</label>

            <div class="col-md-6">
                <input id="symbol" type="text" class="form-control @error('Symbol.symbol') is-invalid @enderror" wire:model.lazy="Symbol.symbol"  value="{{ $Symbol['symbol'] }}" autocomplete="off" autofocus>
                @error('Symbol.symbol')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-6 row mb-3">
            <label for="icon" class="col-md-4 col-form-label">icon:</label>

            <div class="col-md-6">
                <input id="icon" type="text" class="form-control @error('Symbol.icon') is-invalid @enderror" wire:model.lazy="Symbol.icon"  value="{{ $Symbol['icon'] }}" autocomplete="off" autofocus>
                @error('Symbol.icon')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="text-secondary small">Use `Windows button + dot` for open emoji on windows</div>

        </div>


        <div class="col-md-12 mt-4 justify-content-center align-items-center d-flex border-1">
            <button type="button" class="btn btn-success mt-4" wire:loading.attr="disabled"
                    wire:click.prevent="save">
                Submit
            </button>
        </div>
    </div>
</div>
