@section('title')
    {{ $setting->title_home }} - {{ config('app.name', 'Laravel') }}
@endsection
<main id="main">
    <div class="container">
        <!--MAIN SLIDE-->
        <div class="wrap-main-slide">
            <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true"
                data-dots="false">
                @foreach ($sliders as $slider)
                    <div class="item-slide">
                        <img src="{{ asset('assets/images/sliders') }}/{{ $slider->image }}" alt=""
                            class="img-slide">
                        <div class="slide-info slide-1">
                            <h2 class="f-title">{{ $slider->title }}</h2>
                            <span class="subtitle">{{ $slider->subtitle }}</span>.</span>
                            <p class="sale-info">{{ __('Only price') }}: <span
                                    class="price">${{ $slider->price }}</span></p>
                            <a href="{{ $slider->link }}" class="btn-link">{{ __('Shop now') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!--BANNER-->
        @if ($setting->banner_home)
            <div class="wrap-banner style-twin-default">
                <div class="banner-item">
                    <a href="#" class="link-banner banner-effect-1">
                        <figure><img src="{{ asset('assets/images') }}/{{ $setting->banner_home }}" alt=""
                                width="580" height="190"></figure>
                    </a>
                </div>
                <div class="banner-item">
                    <a href="#" class="link-banner banner-effect-1">
                        <figure><img src="{{ asset('assets/images') }}/{{ $setting->banner_home }}" alt=""
                                width="580" height="190"></figure>
                    </a>
                </div>
            </div>
        @endif


        @if ($saleProducts->count() > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
            <!--On Sale-->
            <div class="wrap-show-advance-info-box style-1 has-countdown">
                <h3 class="title-box">{{ __('On Sale') }}</h3>
                <div class="wrap-countdown mercado-countdown"
                    data-expire="{{ Carbon\Carbon::parse($sale->sale_date)->format('Y/m/d H:i:s') }}"></div>
                <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5"
                    data-loop="false" data-nav="true" data-dots="false" data-responsive=''>
                    @foreach ($saleProducts as $saleProduct)
                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="{{ route('product.details', ['slug' => $saleProduct->slug]) }}"
                                    title="{{ $saleProduct->name }}">
                                    <figure><img
                                            src="{{ asset('assets/images/products') }}/{{ $saleProduct->image }}"
                                            width="800" height="800" alt="{{ $saleProduct->name }}"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item new-label">{{ __('new') }}</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">{{ __('quick view') }}</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="{{ route('product.details', ['slug' => $saleProduct->slug]) }}"
                                    class="product-name"><span>{{ $saleProduct->name }}</span></a>
                                <div class="wrap-price"><ins>
                                        <p class="product-price">{{ number_format($saleProduct->price) }}$</p>
                                    </ins> <del>
                                        <p class="product-price">{{ number_format($saleProduct->sale_price) }}$</p>
                                    </del></div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @endif

        <!--Latest Products-->
        <div class="wrap-show-advance-info-box style-1">
            <h3 class="title-box">{{ __('Latest Products') }}</h3>
            @if ($setting->banner_home_product_new)
                <div class="wrap-top-banner">
                    <a href="#" class="link-banner banner-effect-2">
                        <figure><img src="{{ asset('assets/images') }}/{{ $setting->banner_home_product_new }}"
                                width="1170" height="240" alt=""></figure>
                    </a>
                </div>
            @endif

            <div class="wrap-products">
                <div class="wrap-product-tab tab-style-1">
                    <div class="tab-contents">
                        <div class="tab-content-item active" id="digital_1a">
                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container"
                                data-items="5" data-loop="false" data-nav="true" data-dots="false"
                                data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                                @foreach ($lastProducts as $lastProduct)
                                    <div class="product product-style-2 equal-elem ">
                                        <div class="product-thumnail">
                                            <a href="{{ route('product.details', ['slug' => $lastProduct->slug]) }}"
                                                title="{{ $lastProduct->name }}">
                                                <figure><img
                                                        src="{{ asset('assets/images/products') }}/{{ $lastProduct->image }}"
                                                        width="800" height="800"
                                                        alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                            </a>
                                            <div class="group-flash">
                                                <span class="flash-item new-label">{{ __('new') }}</span>
                                            </div>
                                            <div class="wrap-btn">
                                                <a href="#" class="function-link">{{ __('quick view') }}</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <a href="#"
                                                class="product-name"><span>{{ $lastProduct->name }}</span></a>
                                            <div class="wrap-price"><span
                                                    class="product-price">{{ number_format($lastProduct->price) }}$</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Product Categories-->
        <div class="wrap-show-advance-info-box style-1">
            <h3 class="title-box">{{ __('Product Categories') }}</h3>
            @if ($setting->banner_home_category_new)
                <div class="wrap-top-banner">
                    <a href="#" class="link-banner banner-effect-2">
                        <figure><img src="{{ asset('assets/images') }}/{{ $setting->banner_home_category_new }}"
                                width="1170" height="240" alt=""></figure>
                    </a>
                </div>
            @endif
            <div class="wrap-products">
                <div class="wrap-product-tab tab-style-1">
                    <div class="tab-control">
                        @foreach ($categories as $key => $category)
                            <a href="#category_{{ $category->id }}"
                                class="tab-control-item {{ $key == 0 ? 'active' : '' }}">{{ $category->name }}</a>
                        @endforeach
                    </div>

                    <div class="tab-contents">
                        @foreach ($categories as $key => $category)
                            <div class="tab-content-item {{ $key == 0 ? 'active' : '' }}"
                                id="category_{{ $category->id }}">
                                <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container"
                                    data-items="5" data-loop="false" data-nav="true" data-dots="false"
                                    data-responsive=''>
                                    @php
                                        $c_products = DB::table('products')
                                            ->where('category_id', $category->id)
                                            ->get()
                                            ->take($numberOfProducts);
                                    @endphp
                                    @foreach ($c_products as $c_product)
                                        <div class="product product-style-2 equal-elem ">
                                            <div class="product-thumnail">
                                                <a href="{{ route('product.details', ['slug' => $c_product->slug]) }}"
                                                    title="{{ $c_product->name }}">
                                                    <figure><img
                                                            src="{{ asset('assets/images/products') }}/{{ $c_product->image }}"
                                                            width="800" height="800"
                                                            alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                                    </figure>
                                                </a>
                                                <div class="group-flash">
                                                    <span class="flash-item new-label">{{ __('new') }}</span>
                                                </div>
                                                <div class="wrap-btn">
                                                    <a href="#"
                                                        class="function-link">{{ __('quick view') }}</a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <a href="{{ route('product.details', ['slug' => $c_product->slug]) }}"
                                                    class="product-name"><span>{{ $c_product->name }}</span></a>
                                                <div class="wrap-price"><span
                                                        class="product-price">{{ number_format($c_product->price) }}$</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
