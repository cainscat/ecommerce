@extends('admin.layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Partner List</h3>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <a href="{{ url('admin/partner/add') }}" class="btn btn-primary">Add New Partner</a>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @include('admin.layouts._message')

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Partner List</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Link</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                    <tr class="align-middle">
                                        <td>{{ $value->id }}</td>
                                        <td>
                                            @if(!empty($value->getImage()))
                                                <img src="{{ $value->getImage() }}" style="width: 80px; height:20px;">
                                            @endif
                                        </td>
                                        <td>{{ $value->button_link }}</td>
                                        <td>{{ ($value->status == 0) ? 'Active' : 'InActive' }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('admin/partner/edit/'.$value->id) }}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                            <a href="{{ url('admin/partner/delete/'.$value->id) }}" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div style="padding: 10px; float: right;">
                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection
