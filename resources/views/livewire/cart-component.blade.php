@section('title')
{{ __('Cart') }} - {{ config('app.name', 'Laravel') }}
@endsection
	<main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">{{ __('home') }}</a></li>
					<li class="item-link"><span>{{ __('cart') }}</span></li>
				</ul>
			</div>
			<div class=" main-content-area">
					<div class="wrap-iten-in-cart">
						@if (Session::has('success_message'))
							<div class="alert alert-success">
								<strong>{{ __('Success') }}</strong> {{Session::get('success_message')}}
							</div>
						@endif
						@if (Cart::instance('cart')->count() > 0)
							<h3 class="box-title">{{ __('Products Name') }}</h3>
							<ul class="products-cart">
								@foreach (Cart::instance('cart')->content() as $item)
										<li class="pr-cart-item">
											<div class="product-image">
												<figure><img src="{{ asset('assets/images/products') }}/{{ $item->model->image }}" alt="{{ $item->model->name }}"></figure>
											</div>
											<div class="product-name">
												<a class="link-to-product" href="{{ route('product.details', ['slug' => $item->model->slug]) }}">{{ $item->model->name }}</a>
											</div>

											@foreach ($item->options as $key => $value)
												<div style="vertical-align:middle; with:180px;">
													<p><b>{{$key}}: </b> {{$value}}</p>
												</div>
											@endforeach

											@if($item->model->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
												<div class="price-field product-price"><p class="regprice">{{ $item->model->sale_price }}{{ __('$') }}</p></div>
											@else
													<div class="price-field product-price"><p class="price">{{ number_format($item->model->price) }}{{ __('$') }}</p></div>
											@endif
											<div class="quantity">
												<div class="quantity-input">
													<input type="text" name="product-quatity" value="{{ $item->qty }}" data-max="120" pattern="[0-9]*" >
													<a class="btn btn-increase" href="#" wire:click.prevent="increaseQuantity('{{ $item->rowId}}')"></a>
													<a class="btn btn-reduce" href="#" wire:click.prevent="decreaseQuantity('{{ $item->rowId}}')"></a>
												</div>
												<p class="text-center"><a href="#" wire:click.prevent="switchToSaveForLater('{{$item->rowId}}')">{{ __('Save for Later') }}</a></p>
											</div>
											<div class="price-field sub-total"><p class="price">{{ number_format($item->subtotal(0)) }}{{ __('$') }}</p></div>
											<div class="delete">
												<a href="#" class="btn btn-delete" title="Delete Item" wire:click.prevent="deleteProduct('{{ $item->rowId}}')">
													<i class="fa fa-times-circle" aria-hidden="true"></i>
												</a>
											</div>
										</li>
								@endforeach
							</ul>
					</div>

					<div class="summary">
						<div class="order-summary">
							<h4 class="title-box">{{ __('Order Summary') }}</h4>
							<p class="summary-info"><span class="title">{{ __('Subtotal') }}</span><b class="index">{{ number_format(Cart::instance('cart')->subtotal()) }}{{ __('$') }}</b></p>
							@if (Session::has('coupon'))
								<p class="summary-info"><span class="title">{{ __('Discount') }} <b>({{Session::get('coupon')['code']}})</b> <a href="#" wire:click.prevent="removeCoupon"><i class="fa fa-times text-danger"></i> </a></span><b class="index"> - {{ number_format($discount) }}{{ __('$') }}</b></p>
								<p class="summary-info"><span class="title">{{ __('Tax') }} ({{config('cart.tax')}}%)</span><b class="index">{{number_format($taxAfterDiscount)}}{{ __('$') }}</b></p>
								<p class="summary-info"><span class="title">{{ __('Subtotal with Discount') }}</span><b class="index">{{number_format($subtotalAfterDiscount)}}{{ __('$') }}</b></p>
								<p class="summary-info total-info "><span class="title">{{ __('Total') }}</span><b class="index">{{number_format($totalAfterDiscount)}}{{ __('$') }}</b></p>
							@else
								<p class="summary-info"><span class="title">{{ __('Tax') }}</span><b class="index">{{ number_format(Cart::instance('cart')->tax()) }}{{ __('$') }}</b></p>
								<p class="summary-info total-info "><span class="title">{{ __('Total') }}</span><b class="index">{{ number_format(Cart::instance('cart')->total()) }}{{ __('$') }}</b></p>
							@endif
						</div>

						<div class="checkout-info">
						@if (!Session::has('coupon'))
								<label class="checkbox-field">
									<input class="frm-input " name="have-code" id="have-code" value="" type="checkbox" wire:model="haveCouponCode"><span>{{ __('I have coupon code') }}</span>
								</label>
								@if ($haveCouponCode)
									<div class="summary-item">
										<form action="" wire:submit.prevent="applyCouponCode">
											@if (Session::has('coupon_message'))
												<div class="alert alert-danger" role="danger">{{ Session::get('coupon_message') }}</div>
											@endif
											<p class="row-in-form">
												<label for="coupon-code">{{ __('Enter your Coupon Code') }}:</label>
												<input type="text" name="coupon-code" placeholder="Enter Coupon Code..." wire:model="couponCode" />
											</p>
											<button type="submit" class="btn btn-small">{{ __('Apply') }}</button>
										</form>
									</div>
								@endif
						@endif
							<a class="btn btn-checkout" href="#" wire:click.prevent="checkout">{{ __('Checkout') }}</a>
							<a class="link-to-shop" href="shop.html">{{ __('Continue Shopping') }}<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
						</div>
						<div class="update-clear">
							<a class="btn btn-clear" href="#" wire:click.prevent="deleteAllProduct()">{{ __('Clear Shopping Cart') }}</a>
						</div>
					</div>
				@else
					<div class="text-center pt-30">
						<h1>{{ __('Your cart is empty') }}!</h1>
						<p>{{ __('Add items to it nows') }}</p>
						<a href="/shop" class="btn btn-success">{{ __('Shoping Now') }}!</a>
					</div>
				@endif

				<div class="wrap-iten-in-cart">
					<h3 class="title-box" style="border-bottom: 1px solid;padding-bottom: 15px;"> {{Cart::instance('saveForLater')->count()}} {{ __('item(s) Save For Later') }}</h3>
					@if (Session::has('s_success_message'))
						<div class="alert alert-success">
							<strong>{{ __('Success') }}</strong> {{Session::get('s_success_message')}}
						</div>
					@endif
					@if (Cart::instance('saveForLater')->count() > 0)
						<h3 class="box-title">{{ __('Products Name') }}</h3>
						<ul class="products-cart">
							@foreach (Cart::instance('saveForLater')->content() as $item)
									<li class="pr-cart-item">
										<div class="product-image">
											<figure><img src="{{ asset('assets/images/products') }}/{{ $item->model->image }}" alt="{{ $item->model->name }}"></figure>
										</div>
										<div class="product-name">
											<a class="link-to-product" href="{{ route('product.details', ['slug' => $item->model->slug]) }}">{{ $item->model->name }}</a>
										</div>
										@if($item->model->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
											<div class="price-field product-price"><p class="regprice">{{ $item->model->sale_price }}{{ __('$') }}</p></div>
										@else
												<div class="price-field product-price"><p class="price">{{ $item->model->regular_price }}{{ __('$') }}</p></div>
										@endif
										<div class="quantity">
											<p class="text-center"><a href="#" wire:click.prevent="moveToCart('{{$item->rowId}}')">{{ __('Move to Cart') }}</a></p>
										</div>
										<div class="delete">
											<a href="#" class="btn btn-delete" title="Delete Item" wire:click.prevent="deleteFromSaveForLater('{{ $item->rowId}}')">
												<span>{{ __('Delete from save for later') }}</span>
												<i class="fa fa-times-circle" aria-hidden="true"></i>
											</a>
										</div>
									</li>
							@endforeach
						</ul>
				</div>
				@else
					<p>{{ __('No item save for later') }}.</p>
				@endif

{{--				<div class="wrap-show-advance-info-box style-1 box-in-site">--}}
{{--					<h3 class="title-box">Most Viewed Products</h3>--}}
{{--					<div class="wrap-products">--}}
{{--						<div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >--}}

{{--							<div class="product product-style-2 equal-elem ">--}}
{{--								<div class="product-thumnail">--}}
{{--									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">--}}
{{--										<figure><img src="{{ asset('assets/images/products/digital_04.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>--}}
{{--									</a>--}}
{{--									<div class="group-flash">--}}
{{--										<span class="flash-item new-label">new</span>--}}
{{--									</div>--}}
{{--									<div class="wrap-btn">--}}
{{--										<a href="#" class="function-link">quick view</a>--}}
{{--									</div>--}}
{{--								</div>--}}
{{--								<div class="product-info">--}}
{{--									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>--}}
{{--									<div class="wrap-price"><span class="product-price">$250.00</span></div>--}}
{{--								</div>--}}
{{--							</div>--}}

{{--							<div class="product product-style-2 equal-elem ">--}}
{{--								<div class="product-thumnail">--}}
{{--									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">--}}
{{--										<figure><img src="{{ asset('assets/images/products/digital_17.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>--}}
{{--									</a>--}}
{{--									<div class="group-flash">--}}
{{--										<span class="flash-item sale-label">sale</span>--}}
{{--									</div>--}}
{{--									<div class="wrap-btn">--}}
{{--										<a href="#" class="function-link">quick view</a>--}}
{{--									</div>--}}
{{--								</div>--}}
{{--								<div class="product-info">--}}
{{--									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>--}}
{{--									<div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>--}}
{{--								</div>--}}
{{--							</div>--}}

{{--							<div class="product product-style-2 equal-elem ">--}}
{{--								<div class="product-thumnail">--}}
{{--									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">--}}
{{--										<figure><img src="{{ asset('assets/images/products/digital_15.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>--}}
{{--									</a>--}}
{{--									<div class="group-flash">--}}
{{--										<span class="flash-item new-label">new</span>--}}
{{--										<span class="flash-item sale-label">sale</span>--}}
{{--									</div>--}}
{{--									<div class="wrap-btn">--}}
{{--										<a href="#" class="function-link">quick view</a>--}}
{{--									</div>--}}
{{--								</div>--}}
{{--								<div class="product-info">--}}
{{--									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>--}}
{{--									<div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>--}}
{{--								</div>--}}
{{--							</div>--}}

{{--							<div class="product product-style-2 equal-elem ">--}}
{{--								<div class="product-thumnail">--}}
{{--									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">--}}
{{--										<figure><img src="{{ asset('assets/images/products/digital_01.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>--}}
{{--									</a>--}}
{{--									<div class="group-flash">--}}
{{--										<span class="flash-item bestseller-label">Bestseller</span>--}}
{{--									</div>--}}
{{--									<div class="wrap-btn">--}}
{{--										<a href="#" class="function-link">quick view</a>--}}
{{--									</div>--}}
{{--								</div>--}}
{{--								<div class="product-info">--}}
{{--									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>--}}
{{--									<div class="wrap-price"><span class="product-price">$250.00</span></div>--}}
{{--								</div>--}}
{{--							</div>--}}

{{--							<div class="product product-style-2 equal-elem ">--}}
{{--								<div class="product-thumnail">--}}
{{--									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">--}}
{{--										<figure><img src="{{ asset('assets/images/products/digital_21.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>--}}
{{--									</a>--}}
{{--									<div class="wrap-btn">--}}
{{--										<a href="#" class="function-link">quick view</a>--}}
{{--									</div>--}}
{{--								</div>--}}
{{--								<div class="product-info">--}}
{{--									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>--}}
{{--									<div class="wrap-price"><span class="product-price">$250.00</span></div>--}}
{{--								</div>--}}
{{--							</div>--}}

{{--							<div class="product product-style-2 equal-elem ">--}}
{{--								<div class="product-thumnail">--}}
{{--									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">--}}
{{--										<figure><img src="{{ asset('assets/images/products/digital_03.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>--}}
{{--									</a>--}}
{{--									<div class="group-flash">--}}
{{--										<span class="flash-item sale-label">sale</span>--}}
{{--									</div>--}}
{{--									<div class="wrap-btn">--}}
{{--										<a href="#" class="function-link">quick view</a>--}}
{{--									</div>--}}
{{--								</div>--}}
{{--								<div class="product-info">--}}
{{--									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>--}}
{{--									<div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>--}}
{{--								</div>--}}
{{--							</div>--}}

{{--							<div class="product product-style-2 equal-elem ">--}}
{{--								<div class="product-thumnail">--}}
{{--									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">--}}
{{--										<figure><img src="{{ asset('assets/images/products/digital_04.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>--}}
{{--									</a>--}}
{{--									<div class="group-flash">--}}
{{--										<span class="flash-item new-label">new</span>--}}
{{--									</div>--}}
{{--									<div class="wrap-btn">--}}
{{--										<a href="#" class="function-link">quick view</a>--}}
{{--									</div>--}}
{{--								</div>--}}
{{--								<div class="product-info">--}}
{{--									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>--}}
{{--									<div class="wrap-price"><span class="product-price">$250.00</span></div>--}}
{{--								</div>--}}
{{--							</div>--}}

{{--							<div class="product product-style-2 equal-elem ">--}}
{{--								<div class="product-thumnail">--}}
{{--									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">--}}
{{--										<figure><img src="{{ asset('assets/images/products/digital_05.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>--}}
{{--									</a>--}}
{{--									<div class="group-flash">--}}
{{--										<span class="flash-item bestseller-label">Bestseller</span>--}}
{{--									</div>--}}
{{--									<div class="wrap-btn">--}}
{{--										<a href="#" class="function-link">quick view</a>--}}
{{--									</div>--}}
{{--								</div>--}}
{{--								<div class="product-info">--}}
{{--									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>--}}
{{--									<div class="wrap-price"><span class="product-price">$250.00</span></div>--}}
{{--								</div>--}}
{{--							</div>--}}
{{--						</div>--}}
{{--					</div><!--End wrap-products-->--}}
{{--				</div>--}}

			</div><!--end main content area-->
		</div><!--end container-->

	</main>
	<!--main area-->
