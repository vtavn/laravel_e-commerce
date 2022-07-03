@section('title')
    {{ __('Edit Slider') }}
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Edit Slider') }}</h3>

                        <div class="card-tools">
                            <a href="{{ route('admin.homeslider') }}"
                                class="btn btn-success btn-sm pull-right">{{ __('All Sliders') }}</a>
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
                        <form action="" class="form-horizontal" wire:submit.prevent="updateSlider">
                            <div class="form-group">
                                <label class=" control-label">{{ __('Title') }}</label>
                                <div class="">
                                    <input type="text" placeholder="Title" class="form-control input-md" wire:model="title" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" control-label">{{ __('Sub Title') }}</label>
                                <div class="">
                                    <input type="text" placeholder="Sub Title" class="form-control input-md" wire:model="subtitle" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" control-label">{{ __('Price') }}</label>
                                <div class="">
                                    <input type="text" placeholder="Price" class="form-control input-md" wire:model="price" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" control-label">{{ __('Link') }}</label>
                                <div class="">
                                    <input type="text" placeholder="Link" class="form-control input-md" wire:model="link" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" control-label">{{ __('Image') }}</label>
                                <div class="">
                                    <input type="file" class="input-file" wire:model="newImage" />
                                    @if ($newImage)
                                        <img src="{{ $newImage->temporaryUrl() }}" width="120" alt="" />
                                    @else
                                        <img src="{{ asset('assets/images/sliders')}}/{{ $image }}" width="120" alt="" />
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" control-label">{{ __('Status') }}</label>
                                <div class="">
                                    <select class="form-control" wire:model="status">
                                        <option value="0">{{ __('In Active') }}</option>
                                        <option value="1">{{ __('Active') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" control-label"></label>
                                <div class="">
                                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
