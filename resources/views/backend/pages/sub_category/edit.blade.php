@extends('admin.layout.main')
@section('body')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Brand</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add brand</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('update.subcategory') }}">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $SubCategory->id }}">
                    {{-- category list  --}}
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Sub Category update</h6>
                        </div>
                        <div class="col-sm-10 text-secondary">
                            <div class="form-group">
                                <select class="form-select mb-3" aria-label="Default select example" name="category_id">


                                    @foreach ($allCategory as $option)
                                        <option value="{{ $option->id }}"
                                            {{ $option->id == $SubCategory->category_id ? 'selected' : '' }}>
                                            {{ $option->category_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                        </div>
                    </div>

                    {{-- category name  --}}
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Sub Category Name</h6>
                        </div>
                        <div class="col-sm-10 text-secondary">
                            <div class="form-group">
                                <input type="text" class="form-control" name="sub_category_name"
                                    value="{{ $SubCategory->name }}">
                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10 text-secondary">
                            <input type="submit" class="btn btn-primary px-4" value="Save Changes">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
