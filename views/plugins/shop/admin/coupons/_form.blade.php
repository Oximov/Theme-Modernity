@include('admin.elements.date-picker')

@csrf

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="codeInput">{{ trans('shop::messages.fields.code') }}</label>
        <input type="text" class="form-control @error('code') is-invalid @enderror" id="codeInput" name="code" value="{{ old('code', $coupon->code ?? '') }}" required>

        @error('code')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="discountInput">{{ trans('shop::messages.fields.discount') }}</label>
        <div class="input-group">
            <input type="number" min="0" max="100" class="form-control @error('discount') is-invalid @enderror" id="discountInput" name="discount" value="{{ old('discount', $coupon->discount ?? '') }}" required>
            <div class="input-group-append">
                <span class="input-group-text">%</span>
            </div>

            @error('discount')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="startInput">{{ trans('shop::admin.coupons.start_date') }}</label>
        <input type="text" class="form-control date-picker @error('start_at') is-invalid @enderror" id="startInput" name="start_at" value="{{ old('start_at', $coupon->start_at ?? now()) }}" required>

        @error('start_at')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="expireInput">{{ trans('shop::admin.coupons.expire_date') }}</label>
        <input type="text" class="form-control date-picker @error('expire_at') is-invalid @enderror" id="expireInput" name="expire_at" value="{{ old('expire_at', $coupon->expire_at ?? now()->addWeek()) }}" required>

        @error('expire_at')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-group">
    <label>{{ trans('shop::admin.coupons.packages') }}</label>

    <div class="card card-body pb-0">
        @foreach($packages as $category => $packagess)
            <h5>{{ $category }}</h5>

            @foreach($packagess as $package)
                <div class="form-group custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="packages{{ $package->id }}" name="packages[{{ $package->id }}]" @if(Arr::has($coupon->packages ?? [], $package->id)) checked @endif>
                    <label class="custom-control-label" for="packages{{ $package->id }}">{{ $package->name }}</label>
                </div>
            @endforeach
        @endforeach
    </div>

    @error('packages')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="userLimitInput">{{ trans('shop::admin.coupons.user_limit') }}</label>
        <input type="text" class="form-control @error('user_limit') is-invalid @enderror" id="userLimitInput" name="user_limit" value="{{ old('user_limit', $coupon->user_limit ?? '') }}">

        @error('user_limit')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="globalLimitInput">{{ trans('shop::admin.coupons.global_limit') }}</label>
        <input type="text" class="form-control @error('global_limit') is-invalid @enderror" id="globalLimitInput" name="global_limit" value="{{ old('global_limit', $coupon->global_limit ?? '') }}">

        @error('global_limit')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-group custom-control custom-switch">
    <input type="checkbox" class="custom-control-input" id="enableSwitch" name="is_enabled" @if($coupon->is_enabled ?? true) checked @endif>
    <label class="custom-control-label" for="enableSwitch">{{ trans('shop::admin.offers.enable') }}</label>
</div>
