<div>
    <main id="main" class="main-site left-sidebar">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="/" class="link">{{ __('home') }}</a></li>
                    <li class="item-link"><span>{{ __('Contact us') }}</span></li>
                </ul>
            </div>
            <div class="row">
                <div class=" main-content-area">
                    <div class="wrap-contacts ">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <div class="contact-box contact-form">
                                <h2 class="box-title">{{ __('Leave a Message') }}</h2>
                                @if (Session::has('message'))
                                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                                @endif
                                <form name="frm-contact" wire:submit.prevent="sendMessage">

                                    <label for="name">{{ __('Name') }}<span>*</span></label>
                                    @error('name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                    <input type="text" value="" id="name" name="name" wire:model="name">


                                    <label for="email">{{ __('Email') }}<span>*</span></label>
                                    @error('email')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                    <input type="text" value="" id="email" name="email" wire:model="email">


                                    <label for="phone">{{ __('Number Phone') }}</label>
                                    @error('phone')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                    <input type="text" value="" id="phone" name="phone" wire:model="phone">


                                    <label for="comment">{{ __('Comment') }}</label>
                                    @error('comment')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                    <textarea name="comment" id="comment" wire:model="comment"></textarea>

                                    <input type="submit" name="ok" value="Submit">

                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <div class="contact-box contact-info">
                                <div class="wrap-map">
                                    <iframe src="{{ $setting->map}}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                                <h2 class="box-title">{{ __('Contact Detail') }}</h2>
                                <div class="wrap-icon-box">

                                    <div class="icon-box-item">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        <div class="right-info">
                                            <b>{{ __('Email') }}</b>
                                            <p>{{$setting->email}}</p>
                                        </div>
                                    </div>

                                    <div class="icon-box-item">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <div class="right-info">
                                            <b>{{ __('Phone') }}</b>
                                            <p>{{$setting->phone}}</p>
                                        </div>
                                    </div>

                                    <div class="icon-box-item">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <div class="right-info">
                                            <b>{{ __('Address') }}</b>
                                            <p>{{$setting->address}}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end main products area-->

            </div>
            <!--end row-->

        </div>
        <!--end container-->

    </main>
</div>
