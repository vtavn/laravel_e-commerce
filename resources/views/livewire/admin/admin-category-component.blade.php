@section('title')
{{ __('All Category') }}
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-default">
                    <div class="card-header">
                      <h3 class="card-title">{{ __('All Category') }}</h3>
                      
                      <div class="card-tools">
                        <a href="{{ route('admin.categories.add') }}" class="btn btn-success btn-sm pull-right">{{ __('Add Category') }}</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        @if (Session::has('message'))
                          <div class="alert alert-success">{{ Session::get('message') }}</div>
                      @endif
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <td>{{ __('Id') }}</td>
                                    <td>{{ __('Category Name') }}</td>
                                    <td>{{ __('Slug') }}</td>
                                    <th>{{ __('Sub Category') }}</th>
                                    <td>{{ __('Action') }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <th>{{ $category->id }}</th>
                                        <th>{{ $category->name }}</th>
                                        <th>{{ $category->slug }}</th>
                                        <th>
                                            <ul class="sclist">
                                                @foreach ($category->subCategories as $scategory)
                                                    <li>{{ $scategory->name }} <a href="{{route('admin.categories.edit',['category_slug'=>$category->slug,'scategory_slug'=>$scategory->slug])}}"><i class="fa fa-edit"></i></a>                                            
                                                        <a href="#" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click.prevent="deleteSubCategory({{$scategory->id}})" style="margin-left:10px;"><i class="fa fa-times text-danger"></i></a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </th>
                                        <th>
                                            <a href="{{route('admin.categories.edit', ['category_slug' => $category->slug])}}"><i class="fa fa-edit"></i></a>
                                            <a href="#" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click.prevent="deleteCategory({{$category->id}})" style="margin-left:10px;"><i class="fa fa-times text-danger"></i></a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex mt-3 justify-content-center">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
