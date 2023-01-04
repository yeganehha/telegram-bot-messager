<div>
    <x-slot name="title">{{ 'Edit Admin'}}</x-slot>
    <x-slot name="backRoute">{{ route('admin')}}</x-slot>
    @if($flash_message)
        <div class="alert alert-success">
            {{$flash_message}}
        </div>
    @endif


        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('user.name') is-invalid @enderror" wire:model.lazy="user.name" value="{{ $user['name'] }}" autocomplete="name" autofocus>

                @error('user.name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('user.email') is-invalid @enderror" wire:model.lazy="user.email" value="{{ $user['email'] }}" autocomplete="email">

                @error('user.email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

{{--    <hr>--}}
{{--        <div class="row mb-3">--}}
{{--            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--            <div class="col-md-6">--}}
{{--                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" wire:model.lazy="user.password" autocomplete="new-password">--}}

{{--                <div class="text-secondary small">If you want to change password, fill this.</div>--}}
{{--                @error('user.password')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                    <strong>{{ $message }}</strong>--}}
{{--                </span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                        wire:click.prevent="save">
                    {{ __('Edit') }}
                </button>
            </div>
        </div>

</div>
