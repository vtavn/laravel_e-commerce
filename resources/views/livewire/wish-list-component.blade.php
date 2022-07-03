@section('title')
{{__('Wishlist')}} - {{ config('app.name', 'Laravel') }}
@endsection
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">{{ __('home') }}</a></li>
                <li class="item-link"><span>{{ __('Wishlist') }}</span></li>
            </ul>
        </div>
        <div class="row">
            @if (Cart::instance('wishlist')->count() > 0)
                <ul class="product-list grid-products equal-container">
                    @foreach (Cart::instance('wishlist')->content() as $item )
                        <li class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ">
                            <div class="product product-style-3 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{ route('product.details', ['slug' => $item->model->slug]) }}" title="{{ $item->model->name }}">
                                        <figure><img src="{{ asset('assets/images/products') }}/{{ $item->model->image }}" alt="{{ $item->model->name }}"></figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('product.details', ['slug' => $item->model->slug]) }}" class="product-name"><span>{{ $item->model->name }}</span></a>
                                    <div class="wrap-price"><span class="product-price">{{ $item->model->price }}{{ __('$') }}</span></div>
                                    <a href="#" class="btn add-to-cart" wire:click.prevent="moveProductFormWishlistToCart('{{ $item->rowId }}')">{{ __('Move To Cart') }}</a>
                                <div class="product-wish">
                                    <a href="#" wire:click.prevent="removeWishList({{$item->model->id }});"><i class="fa fa-heart fill-heart"></i></a>
                                </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
            <p><h4>{{ __('No Item in Wishlist') }}</h4></p>
            @endif
        </div><!--end row-->

    </div><!--end container-->

</main>

