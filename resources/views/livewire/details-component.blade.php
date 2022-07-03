@section('title')
{{ $product->name }} - {{ config('app.name', 'Laravel') }}
@endsection
<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">{{ __('home') }}</a></li>
                <li class="item-link"><span>{{ __('detail') }}</span></li>
            </ul>
        </div>
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                <div class="wrap-product-detail">
                    <div class="detail-media">
                        <div class="product-gallery" wire:ignore>
                            <ul class="slides">
                                <li data-thumb="{{ asset('assets/images/products') }}/{{ $product->image }}">
                                    <img src="{{ asset('assets/images/products') }}/{{ $product->image }}"
                                        alt="{{ $product->name }}" />
                                </li>
                                @php
                                    $images = explode(',', $product->images);
                                @endphp
                                @foreach ($images as $image)
                                    @if ($image)
                                        <li data-thumb="{{ asset('assets/images/products') }}/{{ $image }}">
                                            <img src="{{ asset('assets/images/products') }}/{{ $image }}"
                                                alt="{{ $product->name }}" />
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="detail-info">
                        <div class="product-rating">
                            @php
                                $avgrating = 0;
                            @endphp
                            @foreach ($product->orderItems->where('rstatus', 1) as $orderItem)
                                @php
                                    $avgrating = $avgrating + $orderItem->review->rating;
                                @endphp
                            @endforeach
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $avgrating)
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-star color-gray" aria-hidden="true"></i>
                                @endif
                            @endfor
                            <a href="#"
                                class="count-review">({{ $product->orderItems->where('rstatus', 1)->count() }}
                                review)</a>
                        </div>
                        <h2 class="product-name">{{ $product->name }}</h2>
                        <div class="short-desc">
                            {{ $product->description }}
                        </div>
                        @if ($product->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                            <div class="wrap-price">
                                <span class="product-price">${{ $product->sale_price }}</span>
                                <del><span class="product-price price_old">{{ $product->price }}{{ __('$') }}</span></del>
                            </div>
                        @else
                            <div class="wrap-price"><span class="product-price">${{ $product->price }}</span></div>
                        @endif
                        <div class="stock-info in-stock">
                            
                            <p class="availability">{{ __('Availability') }}: <b>@if ($product->stock_status == 'instock')
                                Còn hàng
                            @else
                                Hết hàng
                            @endif</b></p>
                        </div>
                        <div>
                            @foreach ($product->attributeValues->unique('product_attribute_id') as $av)
                                <div class="row" style="margin-top: 20px">
                                    <div class="col-xs-2">
                                        <p>{{ $av->productAttribute->name }}</p>
                                    </div>
                                    <div class="col-xs-10">
                                        <select class="form-control" style="width:200px;" wire:model="satt.{{$av->productAttribute->name}}">
                                            @foreach ($av->productAttribute->attributeValues->where('product_id',$product->id) as $pav)
                                                <option value="{{$pav->value }}">{{ $pav->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="quantity" style="margin-top: 10px;">
                            <span>{{ __('Quantity') }}:</span>
                            <div class="quantity-input">
                                <input type="text" name="product-quatity" value="1" data-max="120"
                                    pattern="[0-9]*" wire:model="qty">

                                <a class="btn btn-reduce" href="#" wire:click.prevent="decreaseQuantity"></a>
                                <a class="btn btn-increase" href="#" wire:click.prevent="increaseQuantity"></a>
                            </div>
                        </div>
                        <div class="wrap-butons">
                            @if ($product->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                <a href="#" class="btn add-to-cart"
                                    wire:click.prevent="store({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price }})">{{ __('Add to Cart') }}</a>
                            @else
                                <a href="#" class="btn add-to-cart"
                                    wire:click.prevent="store({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})">{{ __('Add to Cart') }}</a>
                            @endif
                            <div class="wrap-btn">
                                <a href="#" class="btn btn-compare">{{ __('Add Compare') }}</a>
                                <a href="#" class="btn btn-wishlist">{{ __('Add Wishlist') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="advance-info">
                        <div class="tab-control normal">
                            <a href="#description" class="tab-control-item active">{{ __('description') }}</a>
{{--                            <a href="#add_infomation" class="tab-control-item">Addtional Infomation</a>--}}
                            <a href="#review" class="tab-control-item">{{ __('Reviews') }}</a>
                        </div>
                        <div class="tab-contents">
                            <div class="tab-content-item active" id="description">
                                {{ $product->content }}
                            </div>
                            <div class="tab-content-item " id="add_infomation">
                                <table class="shop_attributes">
                                    <tbody>
                                        <tr>
                                            <th>Weight</th>
                                            <td class="product_weight">1 kg</td>
                                        </tr>
                                        <tr>
                                            <th>Dimensions</th>
                                            <td class="product_dimensions">12 x 15 x 23 cm</td>
                                        </tr>
                                        <tr>
                                            <th>Color</th>
                                            <td>
                                                <p>Black, Blue, Grey, Violet, Yellow</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-content-item " id="review">
                                <div class="wrap-review-form">
                                    <div id="comments">
                                        <h2 class="woocommerce-Reviews-title">{{$product->orderItems->where('rstatus', 1)->count()}} review for <span>{{$product->name}}</span></h2>
                                        <ol class="commentlist">
                                            @foreach ($product->orderItems->where('rstatus', '1') as $orderItem)
                                                <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1"
                                                    id="li-comment-20">
                                                    <div id="comment-20" class="comment_container">
                                                        <img alt="{{ $orderItem->order->user->name }}"
                                                            src="{{ asset('assets/images/profile') }}/{{ $orderItem->order->user->profile->image }}"
                                                            height="80" width="80">
                                                        <div class="comment-text">
                                                            <div class="star-rating">
                                                                <span class="width-{{$orderItem->review->rating * 20}}-percent">Rated <strong
                                                                        class="rating">{{$orderItem->review->rating}}</strong> out of 5</span>
                                                            </div>
                                                            <p class="meta">
                                                                <strong
                                                                    class="woocommerce-review__author">{{$orderItem->order->user->name}}</strong>
                                                                <span class="woocommerce-review__dash">–</span>
                                                                <time class="woocommerce-review__published-date"
                                                                    datetime="2008-02-14 20:00">{{carbon\Carbon::parse($orderItem->review->created_at)->format('d F Y g:i A')}}</time>
                                                            </p>
                                                            <div class="description">
                                                                <p>{{$orderItem->review->comment}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                <div class="widget widget-our-services ">
                    <div class="widget-content">
                        <ul class="our-services">

                            <li class="service">
                                <a class="link-to-service" href="#">
                                    <i class="fa fa-truck" aria-hidden="true"></i>
                                    <div class="right-content">
                                        <b class="title">{{ __('Free Shipping') }}</b>
                                        <span class="subtitle">{{ __('On Oder Over $99') }}</span>
                                        <p class="desc"></p>
                                    </div>
                                </a>
                            </li>

                            <li class="service">
                                <a class="link-to-service" href="#">
                                    <i class="fa fa-gift" aria-hidden="true"></i>
                                    <div class="right-content">
                                        <b class="title">{{ __('Gift') }}</b>
                                        <span class="subtitle">{{ __('Get a gift!') }}</span>
                                        <p class="desc"></p>
                                    </div>
                                </a>
                            </li>

                            <li class="service">
                                <a class="link-to-service" href="#">
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                    <div class="right-content">
                                        <b class="title">{{ __('Order Return') }}</b>
                                        <span class="subtitle">{{ __('Return within 7 days') }}</span>
                                        <p class="desc"></p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div><!-- Categories widget-->

                <div class="widget mercado-widget widget-product">
                    <h2 class="widget-title">{{ __('Popular Products') }}</h2>
                    <div class="widget-content">
                        <ul class="products">
                            @foreach ($popular_products as $popular_product)
                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        <div class="thumbnnail">
                                            <a href="{{ route('product.details', ['slug' => $popular_product->slug]) }}"
                                                title="{{ $popular_product->name }}">
                                                <figure><img
                                                        src="{{ asset('assets/images/products') }}/{{ $popular_product->image }}"
                                                        alt="{{ $popular_product->name }}"></figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('product.details', ['slug' => $popular_product->slug]) }}"
                                                class="product-name"><span>{{ $popular_product->name }}</span></a>
                                            <div class="wrap-price"><span
                                                    class="product-price">${{ $popular_product->price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
            <!--end sitebar-->

            <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="wrap-show-advance-info-box style-1 box-in-site">
                    <h3 class="title-box">{{ __('Related Products') }}</h3>
                    <div class="wrap-products">
                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                            data-loop="false" data-nav="true" data-dots="false"
                            data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>
                            @foreach ($related_products as $related_product)
                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{ route('product.details', ['slug' => $related_product->slug]) }}"
                                            title="{{ $related_product->name }}">
                                            <figure><img
                                                    src="{{ asset('assets/images/products') }}/{{ $related_product->image }}"
                                                    width="214" height="214"
                                                    alt="{{ $related_product->name }}"></figure>
                                        </a>
                                        <div class="group-flash">
                                            <span class="flash-item new-label">{{ __('new') }}</span>
                                        </div>
                                        <div class="wrap-btn">
                                            <a href="#" class="function-link">{{ __('quick view') }}</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ route('product.details', ['slug' => $related_product->slug]) }}"
                                            class="product-name"><span>{{ $related_product->name }}</span></a>
                                        <div class="wrap-price"><span
                                                class="product-price">{{ $related_product->price }}{{ __('$') }}</span></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!--End wrap-products-->
                </div>
            </div>

        </div>
        <!--end row-->

    </div>
    <!--end container-->

</main>
<!--main area-->
