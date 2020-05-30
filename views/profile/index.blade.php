@extends('layouts.app')

@section('title', trans('messages.profile.title'))

@section('content')
<style type="text/css">

    @media screen and (min-width: 720px) {
        ul li{
            list-style-type: none;
            text-align: center;
        }
    }

    @media screen and (max-width: 720px) {
      ul li{
        list-style-type: none;
        text-align: left;
      }
    }

</style>


    <div class="container content-parent">
        <h1 class="title-block" style="color: #ffffff; text-transform: uppercase; text-align: center; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-weight: 900;">{{ trans('messages.profile.title') }}</h1>

        <div class="content mb-4">
            <h5 style="text-align: center;"><img src="https://minotar.net/helm/{{ $user->name }}/100.png" width="35px"> </img> {{ $user->name }}</h5>
            <ul>
                <li>{{ trans('theme::modernity.config.rank') }} : {{ $user->role->name }}</li>
                <li>{{ trans('theme::modernity.config.register_date') }} : {{ format_date($user->created_at, true) }}</li>
                <li>{{ trans('messages.profile.info.2fa', ['2fa' => trans_bool($user->hasTwoFactorAuth())]) }}</li>
            </ul>

            @if($user->hasTwoFactorAuth())
                <form action="{{ route('profile.2fa.disable') }}" method="POST">
                    @csrf

                    <center><button type="submit" class="btn btn-danger">{{ trans('messages.profile.2fa.disable') }}</button></center>
                </form>
            @else
                <center><a class="btn btn-success" href="{{ route('profile.2fa.index') }}">{{ trans('messages.profile.2fa.enable') }}</a></center>
            @endif
        </div>

        @if(! $user->hasVerifiedEmail())
            @if (session('resent'))
                <div class="alert alert-success mb-4" role="alert">
                    {{ trans('auth.verify-sent') }}
                </div>
            @endif

            <div class="alert alert-warning mb-4" role="alert">
                <p>{{ trans('messages.profile.not-verified') }}</p>
                <p>{{ trans('auth.verify-request') }}</p>

                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">{{ trans('auth.verify-resend') }}</button>
                </form>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="content mb-4 box-change-pass">
                    <h5 class="change-mail">{{ trans('messages.profile.change-password') }}</h5>

                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="passwordConfirmPassInput">{{ trans('auth.current-password') }}</label>
                            <input type="password" class="box-change-pass form-control @error('password_confirm_pass') is-invalid @enderror" id="passwordConfirmPassInput" name="password_confirm_pass" required>

                            @error('password_confirm_pass')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="passwordInput">{{ trans('auth.password') }}</label>
                            <input type="password" class="box-change-pass form-control @error('password') is-invalid @enderror" id="passwordInput" name="password" required>

                            @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="confirmPasswordInput">{{ trans('auth.confirm-password') }}</label>
                            <input type="password" class="box-change-pass form-control" id="confirmPasswordInput" name="password_confirmation" required>
                        </div>

                        <center><button type="submit" class="btn btn-primary">{{ trans('messages.actions.update') }}</button></center>                        
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="content mb-4 box-change-pass">
                    <h5 class="change-mail">{{ trans('messages.profile.change-email') }}</h5>

                    <form action="{{ route('profile.email') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="emailInput">{{ trans('auth.email') }}</label>
                            <input type="email" class="box-change-pass form-control @error('email') is-invalid @enderror" id="emailInput" name="email" value="{{ old('email', $user->email) }}" required>

                            @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="emailConfirmPassInput">{{ trans('auth.current-password') }}</label>
                            <input type="password" class="box-change-pass form-control @error('email_confirm_pass') is-invalid @enderror" id="emailConfirmPassInput" name="email_confirm_pass" required>

                            @error('email_confirm_pass')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <center><button type="submit" class="btn btn-primary">{{ trans('messages.actions.update') }}</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
