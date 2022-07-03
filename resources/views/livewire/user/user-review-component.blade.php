@section('title')
{{__('Add Review')}} - {{ config('app.name', 'Laravel') }}
@endsection
<div>
    <div class="container pt-30">
        <div class="row">
            <div class="col-md-12">
                <div id="review_form_wrapper">

                    <div id="comments">
                        <h2 class="woocommerce-Reviews-title">{{ __('Add review for') }}</h2>
                        <ol class="commentlist">
                            <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
                                <div id="comment-20" class="comment_container"> 
                                    <img alt="" src="{{ asset('assets/images/products') }}/{{$orderItem->product->image}}" height="80" width="80">
                                    <div class="comment-text">
                                        <p class="meta"> 
                                            <strong class="woocommerce-review__author">{{$orderItem->product->name}}</strong> 
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </div><!-- #comments -->

                    <div id="review_form">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <div id="respond" class="comment-respond"> 

                            <form action="#" method="post" id="commentform" class="comment-form" novalidate="" wire:submit.prevent="addReview">
                                <div class="comment-form-rating">
                                    <span>{{ __('Your rating') }}</span>
                                    <p class="stars">
                                        
                                        <label for="rated-1"></label>
                                        <input type="radio" id="rated-1" name="rating" value="1" wire:model="rating">
                                        <label for="rated-2"></label>
                                        <input type="radio" id="rated-2" name="rating" value="2" wire:model="rating">
                                        <label for="rated-3"></label>
                                        <input type="radio" id="rated-3" name="rating" value="3" wire:model="rating">
                                        <label for="rated-4"></label>
                                        <input type="radio" id="rated-4" name="rating" value="4" wire:model="rating">
                                        <label for="rated-5"></label>
                                        <input type="radio" id="rated-5" name="rating" value="5" checked="checked" wire:model="rating">
                                    </p>
                                    @error('rating')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <p class="comment-form-comment">
                                    <label for="comment">{{ __('Your review') }} <span class="required">*</span>
                                    </label>
                                    @error('comment')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                    <textarea id="comment" name="comment" cols="45" rows="8" wire:model="comment"></textarea>
                                </p>
                                <p class="form-submit">
                                    <input name="submit" type="submit" id="submit" class="submit" value="{{ __('Submit') }}">
                                </p>
                            </form>

                        </div><!-- .comment-respond-->
                    </div><!-- #review_form -->
                </div><!-- #review_form_wrapper -->

            </div>
        </div>
    </div>
</div>
