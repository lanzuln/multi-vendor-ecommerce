@extends('admin.layout.main');
@section('body')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Inactice vendor</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All inactive vendor</li>
                </ol>
            </nav>
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
                            <th>Shop name</th>
                            <th>Vendor user name</th>
                            <th>Join date</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inactive as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->join_date}}</td>
                            <td>{{$item->email}}</td>
                            <td><button class="btn btn-danger"> {{$item->status}}</button></td>

                            <td>
                                <a href="{{route('inactive.vendor.details', $item->id)}}" class="btn btn-success">View</a>
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
