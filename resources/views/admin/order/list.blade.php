@extends('admin.layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Orders List (Total : {{ $getRecord->total() }})</h3>
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
                                <h3 class="card-title">Order Search</h3>
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
                                            <label for="">Company Name</label>
                                            <input type="text" name="company_name" class="form-control" value="{{ Request::get('company_name') }}" placeholder="Company Name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">First Name</label>
                                            <input type="text" name="first_name" class="form-control" value="{{ Request::get('first_name') }}" placeholder="First Name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Last Name</label>
                                            <input type="text" name="last_name" class="form-control" value="{{ Request::get('last_name') }}" placeholder="Last Name">
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
                                            <label for="">Country</label>
                                            <input type="text" name="country" class="form-control" value="{{ Request::get('country') }}" placeholder="Country">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">State</label>
                                            <input type="text" name="state" class="form-control" value="{{ Request::get('state') }}" placeholder="State">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">City</label>
                                            <input type="text" name="city" class="form-control" value="{{ Request::get('city') }}" placeholder="City">
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
                                            <label for="">Postcode</label>
                                            <input type="text" name="postcode" class="form-control" value="{{ Request::get('postcode') }}" placeholder="Postcode">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">From Date</label>
                                            <input type="date" style="padding:6px;" name="from_date" class="form-control" value="{{ Request::get('from_date') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">To Date</label>
                                            <input type="date" style="padding:6px;" name="to_date" class="form-control" value="{{ Request::get('to_date') }}">
                                        </div>
                                    </div>

                                </div>


                                <div class="row pt-2">
                                    <div class="col-md-2">
                                        <button class="btn btn-primary">Search</button>
                                        <a href="{{ url('admin/orders/list') }}" class="btn btn-primary">Reset</a>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </form>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Orders List</h3>
                        </div>

                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Company Name</th>
                                        <th>Country</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Postcode</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Discount Code</th>
                                        <th>Discount Amount ($)</th>
                                        <th>Shipping Amount ($)</th>
                                        <th>Total Amount ($)</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                    <tr class="align-middle">
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                        <td>{{ $value->company_name }}</td>
                                        <td>{{ $value->country }}</td>
                                        <td>{{ $value->address_one }}, {{ $value->address_two }}</td>
                                        <td>{{ $value->city }}</td>
                                        <td>{{ $value->state }}</td>
                                        <td>{{ $value->postcode }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->discount_code }}</td>
                                        <td>{{ number_format($value->discount_amount) }}</td>
                                        <td>{{ number_format($value->shipping_amount) }}</td>
                                        <td>{{ number_format($value->total_amount) }}</td>
                                        <td style="text-transform: capitalize;">{{ $value->payment_method }}</td>
                                        <td></td>
                                        <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('admin/orders/detail/'.$value->id) }}" class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
