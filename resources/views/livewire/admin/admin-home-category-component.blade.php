<div>
    <div class="container pt-30">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Manage Home Categories
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.products')}}" class="btn btn-success pull-right">All Products</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <form action="" class="form-horizontal" wire:submit.prevent="updateHomeCategory">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Choose Categories</label>
                                <div class="col-md-4" wire:ignore>
                                    {{-- <select class="form-control select_categories" name="categories[]" multiple="multiple" wire:model="selectCategories">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select> --}}
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
                                <label class="col-md-4 control-label">No Of Products</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" wire:model="numberOfProducts" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.select_categories').select2();
            $('.select_categories').on('change', function(e){
                var data = $('.select_categories').select2("val");
                @this.set('selectCategories', data);
            });
            
        });
    </script>
@endpush
