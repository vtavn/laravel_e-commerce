@section('title')
    {{ __('Settings') }}
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Settings') }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif
                    <form class="form-horizontal" wire:submit.prevent="saveSettings">
                        <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label class=" control-label">{{ __('Email') }}</label>
                                <div class="">
                                    <input type="text" class="form-control input-md" placeholder="Email" wire:model="email">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label">{{ __('Phone') }}</label>
                                <div class="">
                                    <input type="text" class="form-control input-md" placeholder="Phone" wire:model="phone">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label">{{ __('Phone') }} 2</label>
                                <div class="">
                                    <input type="text" class="form-control input-md" placeholder="Phone 2" wire:model="phone_2">
                                    @error('phone_2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label">{{ __('Address') }}</label>
                                <div class="">
                                    <input type="text" class="form-control input-md" placeholder="Address" wire:model="address">
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label">{{ __('Map') }}</label>
                                <div class="">
                                    <input type="text" class="form-control input-md" placeholder="Map" wire:model="map">
                                    @error('map')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label">{{ __('Twiter') }}</label>
                                <div class="">
                                    <input type="text" class="form-control input-md" placeholder="Twiter" wire:model="twiter">
                                    @error('twiter')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label">{{ __('Facebook') }}</label>
                                <div class="">
                                    <input type="text" class="form-control input-md" placeholder="Facebook" wire:model="facebook">
                                    @error('facebook')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label">{{ __('Instagram') }}</label>
                                <div class="">
                                    <input type="text" class="form-control input-md" placeholder="Instagram" wire:model="instagram">
                                    @error('instagram')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label">{{ __('Telegram') }}</label>
                                <div class="">
                                    <input type="text" class="form-control input-md" placeholder="Telegram" wire:model="telegram">
                                    @error('telegram')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label">{{ __('Youtube') }}</label>
                                <div class="">
                                    <input type="text" class="form-control input-md" placeholder="Youtube" wire:model="youtube">
                                    @error('youtube')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label class=" control-label">{{ __('Choose Categories Header') }}</label>
                                <div class="" wire:ignore>
                                    <select name="categories[]" multiple="multiple" class="select_categories form-control" wire:model="category_home">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label class=" control-label">{{ __('banner_home') }}</label>
                                <div class="">
                                    <input type="text" class="form-control input-md" placeholder="banner home" wire:model="banner_home">
                                    @error('banner_home')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" control-label">{{ __('banner_home_2') }}</label>
                                <div class="">
                                    <input type="text" class="form-control input-md" placeholder="banner home 2" wire:model="banner_home_2">
                                    @error('banner_home_2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label">{{ __('banner_home_product_new') }}</label>
                                <div class="">
                                    <input type="text" class="form-control input-md" placeholder="banner home product" wire:model="banner_home_product_new">
                                    @error('banner_home_product_new')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label">{{ __('banner_home_category_new') }}</label>
                                <div class="">
                                    <input type="text" class="form-control input-md" placeholder="banner home category" wire:model="banner_home_category_new">
                                    @error('banner_home_category_new')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label">{{ __('banner_shop') }}</label>
                                <div class="">
                                    <input type="text" class="form-control input-md" placeholder="banner shop" wire:model="banner_shop">
                                    @error('banner_shop')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label">{{ __('banner_home_category') }}</label>
                                <div class="">
                                    <input type="text" class="form-control input-md" placeholder="banner home category" wire:model="banner_home_category">
                                    @error('banner_home_category')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" control-label"></label>
                                <div class="">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.select_categories').select2({
                theme: 'bootstrap4'
            });
            $('.select_categories').on('change', function(e){
                var data = $('.select_categories').select2("val");
                @this.set('category_home', data);
            });
            
        });
    </script>
@endpush
