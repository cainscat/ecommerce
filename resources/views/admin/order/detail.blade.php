@extends('admin.layouts.app')
    @section('style')
        <style>
            .form-group{
                margin-bottom: 5px;
            }
        </style>
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Order Details</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                            <div class="card-body">

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">ID :</span> {{ $getRecord->id }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Transaction ID :</span> {{ $getRecord->transaction_id }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Name :</span> {{ $getRecord->first_name }} {{ $getRecord->last_name }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Company Name :</span> {{ $getRecord->company_name }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Country :</span> {{ $getRecord->country }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Address :</span> {{ $getRecord->address_one }}, {{ $getRecord->address_two }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">City :</span> {{ $getRecord->city }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">State :</span> {{ $getRecord->state }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Postcode :</span> {{ $getRecord->postcode }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Phone :</span> {{ $getRecord->phone }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Email :</span> {{ $getRecord->email }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Discount Code :</span> {{ $getRecord->discount_code }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Discount Amount ($) :</span> {{ number_format($getRecord->discount_amount) }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Shipping Name :</span> {{ $getRecord->getShipping->name }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Shipping Amount ($) :</span> {{ number_format($getRecord->shipping_amount) }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Total Amount ($) :</span> {{ number_format($getRecord->total_amount) }}</label>
                                </div>

                                <div class="form-group">
                                    <label style="text-transform: capitalize;"><span style="font-weight: bold;">Payment Method :</span> {{ $getRecord->payment_method }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Status :</span> </label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Note :</span> {{ $getRecord->note }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Created Date :</span> {{ date('d-m-Y h:i A', strtotime($getRecord->created_at)) }}</label>
                                </div>

                            </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Product Details</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>QTY</th>
                                        <th>Price ($)</th>
                                        <th>Color Name</th>
                                        <th>Size Name</th>
                                        <th>Size Amount</th>
                                        <th>Total Amount ($)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord->getItem as $item)
                                    @php
                                        $getProductImage = $item->getProduct->getImageSingle($item->getProduct->id);
                                    @endphp
                                        <tr>
                                            <td>
                                                <img style="witdh:100px; height:100px;" src="{{ $getProductImage->getLogo() }}">
                                            </td>
                                            <td>
                                                <a target="_blank" href="{{ url($item->getProduct->slug) }}">{{ $item->getProduct->title }}</a>
                                            </td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->color_name }}</td>
                                            <td>{{ $item->size_name }}</td>
                                            <td>{{ number_format($item->size_amount) }}</td>
                                            <td>{{ number_format($item->total_price) }}</td>
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
