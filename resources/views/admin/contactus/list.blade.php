@extends('admin.layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Contact Us</h3>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @include('admin.layouts._message')

                    <form method="get">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Contact Us Search</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">ID</label>
                                            <input type="text" name="id" class="form-control" value="{{ Request::get('id') }}" placeholder="ID">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ Request::get('name') }}" placeholder="Name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" name="email" class="form-control" value="{{ Request::get('email') }}" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Phone</label>
                                            <input type="text" name="phone" class="form-control" value="{{ Request::get('phone') }}" placeholder="Phone">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Subject</label>
                                            <input type="text" name="subject" class="form-control" value="{{ Request::get('subject') }}" placeholder="Subject">
                                        </div>
                                    </div>


                                </div>


                                <div class="row pt-2">
                                    <div class="col-md-2">
                                        <button class="btn btn-primary">Search</button>
                                        <a href="{{ url('admin/contact_us') }}" class="btn btn-primary">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Contact Us</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Login Name</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                    <tr class="align-middle">
                                        <td>{{ $value->id }}</td>
                                        <td>{{!empty($value->getUser) ? $value->getUser->name : '' }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>{{ $value->subject }}</td>
                                        <td>{{ $value->message }}</td>
                                        <td>{{ $value->created_at }}</td>
                                        <td>
                                            <a href="{{ url('admin/contact_us/delete/'.$value->id) }}" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
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
