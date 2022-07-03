@section('title')
{{__('Thank You')}} - {{ config('app.name', 'Laravel') }}
@endsection
<main id="main" class="main-site">
<div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">{{ __('home') }}</a></li>
                <li class="item-link"><span>{{ __('Thank You') }}</span></li>
            </ul>
        </div>
    </div>

    <div class="container pb-60">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>{{ __('Thank you for your order') }}</h2>
                <p>{{ __('A confirmation email was sent') }}.</p>
                <a href="/shop" class="btn btn-submit btn-submitx">{{ __('Continue Shopping') }}</a>
            </div>
        </div>
    </div><!--end container-->

</main>
