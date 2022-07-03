@section('title')
    {{ __('Manage Home Categories') }}
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Manage Home Categories') }}</h3>

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
                        <form action="" class="form-horizontal" wire:submit.prevent="updateHomeCategory">
                            <div class="form-group">
                                <label class="col-md-4 control-label">{{ __('Choose Categories') }}</label>
                                <div class="col-md-4" wire:ignore>
                                    <select name="categories[]" multiple="multiple" class="select_categories form-control" wire:model="selectCategories">
                                        @foreach ($categories as $category)
                                            <option
                                            @if ($selectCategories != null)
                                                @if (in_array($category->id, $selectCategories))
                                                    selected
                                                @endif
                                            @endif
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label class="col-md-4 control-label">{{ __('No Of Products') }}</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" wire:model="numberOfProducts" />
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
@push('scripts')
    <script>
        $(document).ready(function(){
            $('.select_categories').select2({
                theme: 'bootstrap4'
            });
            $('.select_categories').on('change', function(e){
                var data = $('.select_categories').select2("val");
                @this.set('selectCategories', data);
            });
            
        });
    </script>
@endpush