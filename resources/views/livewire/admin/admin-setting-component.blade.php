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
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Email') }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-md" placeholder="Email" wire:model="email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Phone') }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-md" placeholder="Phone" wire:model="phone">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Phone') }} 2</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-md" placeholder="Phone 2" wire:model="phone_2">
                                @error('phone_2')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Address') }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-md" placeholder="Address" wire:model="address">
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Map') }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-md" placeholder="Map" wire:model="map">
                                @error('map')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Twiter') }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-md" placeholder="Twiter" wire:model="twiter">
                                @error('twiter')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Facebook') }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-md" placeholder="Facebook" wire:model="facebook">
                                @error('facebook')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Instagram') }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-md" placeholder="Instagram" wire:model="instagram">
                                @error('instagram')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Telegram') }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-md" placeholder="Telegram" wire:model="telegram">
                                @error('telegram')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Youtube') }}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-md" placeholder="Youtube" wire:model="youtube">
                                @error('youtube')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
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
