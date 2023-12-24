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
            <form method="post"  action="{{route('store.brand')}}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <h6 class="mb-0">Brand Name</h6>
                    </div>
                    <div class="col-sm-10 text-secondary">
                        <input type="text" class="form-control" name="brand_name">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-2">
                        <h6 class="mb-0">Photo</h6>
                    </div>
                    <div class="col-sm-10 text-secondary">
                        <input type="file"
                            oninput="newImg.src=window.URL.createObjectURL(this.files[0])"
                            class="form-control" name="brand_image" value="">
                    </div>
                </div>
                {{-- preview --}}
                <div class="row mb-3">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10 text-secondary">
                        <img src="{{ asset('default.jpg') }}" id="newImg"
                            alt="Admin" class="image_fit" width="220" height="150">
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
