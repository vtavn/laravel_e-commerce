	<main id="main" class="main-site">
		<div class="container">
			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">{{ __('home') }}</a></li>
					<li class="item-link"><span>{{ __('Checkout') }}</span></li>
				</ul>
			</div>
			<div class=" main-content-area">
				<form action="" wire:submit.prevent="placeOrder" onsubmit="$('#processing').show();">
					<div class="row">
						<div class="col-md-12">
							<div class="wrap-address-billing">
								<h3 class="box-title">{{ __('Billing Address') }}</h3>
								<div class="billing-address">
									<p class="row-in-form">
										<label for="fname">{{ __('Fisrtname') }}<span>*</span></label>
										<input id="fname" type="text" name="fname" value="" placeholder="Your name" wire:model="firstname">
										@error('firstname')
											<span class="error">{{ $message }}</span>
										@enderror
									</p>
									<p class="row-in-form">
										<label for="lname">{{ __('Lastname') }}<span>*</span></label>
										<input id="lname" type="text" name="lname" value="" placeholder="Your last name" wire:model="lastname">
										@error('lastname')
										<span class="error">{{ $message }}</span>
										@enderror
									</p>
									<p class="row-in-form">
										<label for="email">{{ __('Email Addreess') }}:</label>
										<input id="email" type="email" name="email" value="" placeholder="Type your email" wire:model="email">
										@error('email')
										<span class="error">{{ $message }}</span>
										@enderror
									</p>
									<p class="row-in-form">
										<label for="phone">{{ __('Phone') }}<span>*</span></label>
										<input id="phone" type="number" name="phone" value="" placeholder="10 digits format" wire:model="phone">
										@error('phone')
										<span class="error">{{ $message }}</span>
										@enderror
									</p>
									<p class="row-in-form">
										<label for="add">{{ __('Address') }}:</label>
										<input id="add" type="text" name="add" value="" placeholder="Street at apartment number" wire:model="address">
										@error('address')
										<span class="error">{{ $message }}</span>
										@enderror
									</p>

									<p class="row-in-form">
										<label for="add">{{ __('Address') }} 2:</label>
										<input id="add" type="text" name="add" value="" placeholder="Street at apartment number" wire:model="address_2">
										@error('address_2')
										<span class="error">{{ $message }}</span>
										@enderror
									</p>

									<p class="row-in-form">
										<label for="country">{{ __('Country') }}<span>*</span></label>
										<input id="country" type="text" name="country" value="" placeholder="United States" wire:model="country">
										@error('country')
										<span class="error">{{ $message }}</span>
										@enderror
									</p>
									<p class="row-in-form">
										<label for="province">{{ __('Province') }}:</label>
										<input id="province" type="text" name="province" value="" placeholder="Your Province" wire:model="province">
										@error('province')
										<span class="error">{{ $message }}</span>
										@enderror
									</p>
									<p class="row-in-form">
										<label for="city">{{ __('Town / City') }}<span>*</span></label>
										<input id="city" type="text" name="city" value="" placeholder="City name" wire:model="city">
										@error('city')
										<span class="error">{{ $message }}</span>
										@enderror
									</p>
									<p class="row-in-form">
										<label for="zip-code">{{ __('Postcode / ZIP') }}:</label>
										<input id="zip-code" type="number" name="zip-code" value="" placeholder="Your postal code" wire:model="zipcode">
										@error('zipcode')
										<span class="error">{{ $message }}</span>
										@enderror
									</p>
									<p class="row-in-form fill-wife">
										<label class="checkbox-field">
											<input name="different-add" id="different-add" value="forever" type="checkbox" wire:model="shipToDifferent">
											<span>{{ __('Ship to a different address') }}?</span>
										</label>
									</p>
								</div>
							</div>
						</div>

						@if ($shipToDifferent)
							<div class="col-md-12">
								<div class="wrap-address-billing">
									<h3 class="box-title">{{ __('Shipping Address') }}</h3>
									<div class="billing-address">
										<p class="row-in-form">
											<label for="fname">{{ __('Fisrtname') }}<span>*</span></label>
											<input type="text" name="fname" value="" placeholder="Your name" wire:model="s_firstname">
											@error('s_firstname')
											<span class="error">{{ $message }}</span>
											@enderror
										</p>
										<p class="row-in-form">
											<label for="lname">{{ __('Lastname') }}<span>*</span></label>
											<input type="text" name="lname" value="" placeholder="Your last name" wire:model="s_lastname">
											@error('s_lastname')
											<span class="error">{{ $message }}</span>
											@enderror
										</p>
										<p class="row-in-form">
											<label for="email">{{ __('Email Addreess') }}:</label>
											<input type="email" name="email" value="" placeholder="Type your email" wire:model="s_email">
											@error('s_email')
											<span class="error">{{ $message }}</span>
											@enderror
										</p>
										<p class="row-in-form">
											<label for="phone">{{ __('Phone') }}<span>*</span></label>
											<input type="number" name="phone" value="" placeholder="10 digits format" wire:model="s_phone">
											@error('s_phone')
											<span class="error">{{ $message }}</span>
											@enderror
										</p>
										<p class="row-in-form">
											<label for="add">{{ __('Address') }}:</label>
											<input type="text" name="add" value="" placeholder="Street at apartment number" wire:model="s_address">
											@error('s_address')
											<span class="error">{{ $message }}</span>
											@enderror
										</p>

										<p class="row-in-form">
											<label for="add">{{ __('Address') }} 2:</label>
											<input  type="text" name="add" value="" placeholder="Street at apartment number" wire:model="s_address_2">
											@error('s_address_2')
											<span class="error">{{ $message }}</span>
											@enderror
										</p>
										<p class="row-in-form">
											<label for="country">{{ __('Country') }}<span>*</span></label>
											<input  type="text" name="country" value="" placeholder="United States" wire:model="s_country">
											@error('s_country')
											<span class="error">{{ $message }}</span>
											@enderror
										</p>
										<p class="row-in-form">
											<label for="province">{{ __('Province') }}:</label>
											<input  type="text" name="province" value="" placeholder="Your Province" wire:model="s_province">
											@error('s_province')
											<span class="error">{{ $message }}</span>
											@enderror
										</p>
										<p class="row-in-form">
											<label for="city">{{ __('Town / City') }}<span>*</span></label>
											<input  type="text" name="city" value="" placeholder="City name" wire:model="s_city">
											@error('s_city')
											<span class="error">{{ $message }}</span>
											@enderror
										</p>
										<p class="row-in-form">
											<label for="zip-code">{{ __('Postcode / ZIP') }}:</label>
											<input type="number" name="zip-code" value="" placeholder="Your postal code" wire:model="s_zipcode">
											@error('s_zipcode')
											<span class="error">{{ $message }}</span>
											@enderror
										</p>

									</div>
								</div>
							</div>
						@endif

					</div>

					<div class="summary summary-checkout">
						<div class="summary-item payment-method">
							<h4 class="title-box">{{ __('Payment Method') }}</h4>
                            <span>{{ __('Choose medthod payment') }}</span>
							<div class="choose-payment-methods">
								<label class="payment-method">
									<input name="payment-method" id="payment-method-bank" value="cod" type="radio" wire:model="paymentMethod">
									<span>COD</span>
									<span class="payment-desc">{{ __('Order now pay on delivery') }}</span>
								</label>
{{--								<label class="payment-method">--}}
{{--									<input name="payment-method" id="payment-method-visa" value="cart" type="radio" wire:model="paymentMethod">--}}
{{--									<span>Debit/Credit Card</span>--}}
{{--									<span class="payment-desc">There are many variations of passages of Lorem Ipsum available</span>--}}
{{--								</label>--}}
{{--								<label class="payment-method">--}}
{{--									<input name="payment-method" id="payment-method-paypal" value="paypal" type="radio" wire:model="paymentMethod">--}}
{{--									<span>Paypal</span>--}}
{{--									<span class="payment-desc">You can pay with your credit</span>--}}
{{--									<span class="payment-desc">card if you don't have a paypal account</span>--}}
{{--								</label>--}}
								@error('paymentMethod')
											<span class="error">{{ $message }}</span>
											@enderror
							</div>
							@if (Session::has('checkout'))
							<p class="summary-info grand-total"><span>{{ __('Grand Total') }}</span> <span class="grand-total-price">{{number_format(Session::get('checkout')['total'])}}{{ __('$') }}</span></p>
							@endif

							@if ($errors->isEmpty())
								<div id="processing" wire:ignore style="font-size:22px; margin-bottom: 20px; padding-left: 37px;color:green;display:none;">
									<i class="fa fa-spinner fa-pulse fa-fw"></i>
									<span>{{ __('Processing') }}...</span>
								</div>
							@endif

							<button type="submit" class="btn btn-medium">{{ __('Place order now') }}</button>
						</div>
						<div class="summary-item shipping-method">
							<h4 class="title-box f-title">{{ __('Shipping method') }}</h4>
							<p class="summary-info"><span class="title">{{ __('Contact') }}</span></p>
						</div>
					</div>
			</form>
			</div><!--end main content area-->
		</div><!--end container-->

	</main>
	<!--main area-->
