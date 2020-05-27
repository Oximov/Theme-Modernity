@extends('admin.layouts.admin')

@section('title', 'Modernity config')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.themes.config', $theme) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="colorSelect">{{ trans('theme::modernity.config.color') }}</label>
                    <select class="custom-select @error('color') is-invalid @enderror" id="colorSelect" name="color">
                        @foreach(['red', 'blue', 'green', 'purple', 'orange', 'yellow', 'aqua', 'pink'] as $color)
                            <option value="{{ $color }}" @if(theme_config('color') === $color) selected @endif>{{ trans('theme::modernity.colors.'.$color) }}</option>
                        @endforeach
                    </select>

                    @error('color')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="discordInput">{{ trans('theme::modernity.config.discord') }}</label>
                    <input type="text" class="form-control @error('discord-id') is-invalid @enderror" id="discordInput" name="discord-id" value="{{ old('discord-id', config('theme.discord-id')) }}">

                    @error('discord-id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="twitterInput">Twitter</label>
                    <input type="text" class="form-control @error('twitter') is-invalid @enderror" id="twitterInput" name="twitter" value="{{ old('twitter', config('theme.twitter')) }}">

                    @error('twitter')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="titleInput">{{ trans('theme::modernity.config.title') }}</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleInput" name="title" value="{{ old('title', config('theme.title')) }}">

                    @error('title')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="subtitleInput">{{ trans('theme::modernity.config.subtitle') }}</label>
                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitleInput" name="subtitle" value="{{ old('subtitle', config('theme.subtitle')) }}">

                    @error('subtitle')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ trans('messages.actions.save') }}</button>
            </form>
        </div>
    </div>
@endsection
