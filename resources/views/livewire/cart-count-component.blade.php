<div class="wrap-icon-section minicart">
    <a href="{{ route('product.cart') }}" class="link-direction">
        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
        <div class="left-info">
            @if (Cart::instance('cart')->count() > 0)
                <span class="index">{{Cart::instance('cart')->count()}} {{ __('item') }}</span>
            @endif
            <span class="title">{{ __('CART') }}</span>
        </div>
    </a>
</div>
