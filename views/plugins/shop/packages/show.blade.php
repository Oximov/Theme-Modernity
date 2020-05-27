<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="itemModalLabel">{{ $package->name }}</h3>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <center><img class="card-img-top" style="width: 250px;" src="{{ $package->imageUrl() }}" alt=""></center>            
            {!! $package->description !!}
        </div>
        <div class="modal-footer">
            <span class="flex-md-fill font-weight-bold">{{ shop_format_amount($package->price) }}</span>

            @auth
                <form action="{{ route('shop.packages.buy', $package) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn shop-btn">
                        {{ trans('shop::messages.buy') }}
                    </button>
                </form>
            @endauth
        </div>
    </div>
</div>
