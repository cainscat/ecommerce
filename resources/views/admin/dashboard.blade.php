@extends('admin.layouts.app')
    @section('style')
    @endsection
@section('content')
    <main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-12 col-sm-6 col-md-3" style="width: 20%;">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-success shadow-sm"><i class="bi bi-card-list"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Orders</span>
                            <span class="info-box-number">{{ $TotalOrder }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3" style="width: 20%;">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-success shadow-sm"><i class="bi bi-card-list"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Today Orders</span>
                            <span class="info-box-number">{{ $TotalTodayOrder }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3" style="width: 20%;">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-success shadow-sm"><i class="bi bi-credit-card-2-back-fill"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Amount</span>
                            <span class="info-box-number">${{ number_format($TotalAmount) }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3" style="width: 20%;">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-success shadow-sm"><i class="bi bi-credit-card-2-back-fill"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Today Amount</span>
                            <span class="info-box-number">${{ number_format($TotalTodayAmount) }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3" style="width: 20%;">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-success shadow-sm"><i class="bi bi-people-fill"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Customer</span>
                            <span class="info-box-number">{{ $TotalCustomer }}</span>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-12 col-sm-6 col-md-3" style="width: 20%;">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-success shadow-sm"><i class="bi bi-people-fill"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Today Customer</span>
                            <span class="info-box-number">{{ $TotalTodayCustomer }}</span>
                        </div>
                    </div>
                </div> --}}

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Online Store Visitors</h3> <a href="javascript:void(0);" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View Report</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column"> <span class="fw-bold fs-5">820</span> <span>Visitors Over Time</span> </p>
                                <p class="ms-auto d-flex flex-column text-end"> <span class="text-success"> <i class="bi bi-arrow-up"></i> 12.5%
                                    </span> <span class="text-secondary">Since last week</span> </p>
                            </div>
                            <div class="position-relative mb-4">
                                <div id="visitors-chart"></div>
                            </div>
                            <div class="d-flex flex-row justify-content-end"> <span class="me-2"> <i class="bi bi-square-fill text-primary"></i> This Week
                                </span> <span> <i class="bi bi-square-fill text-secondary"></i> Last Week
                                </span> </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header border-0">
                            <h3 class="card-title">Lastest Orders</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Number</th>
                                        <th>Name</th>
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
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getLatestOrders as $value)
                                    <tr class="align-middle">
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->order_number }}</td>
                                        <td>{{ $value->first_name }} {{ $value->last_name }}</td>
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
