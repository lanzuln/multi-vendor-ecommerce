@extends('admin.layout.main');
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
                    <li class="breadcrumb-item active" aria-current="page">All brand</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('create.subcategory')}}" class="btn btn-primary">Add item</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Category name</th>
                            <th>Sub category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($SubCategory as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item['category']['category_name'] ?? ""}}</td>
                            <td>{{$item->name ?? ""}}</td>

                            <td>
                                <a href="{{route('edit.subcategory',$item->id)}}" class="btn btn-success">Edit</a>
                                <a href="{{route('delete.subcategory',$item->id)}}" class="btn btn-danger" id="delete" >Delete</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
