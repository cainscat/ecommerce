@extends('layouts.app')
@section('style')
<style>
    .form-group{
        margin-bottom: 5px;
    }
</style>
@endsection

@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">Order Detail</h1>
        </div>
    </div>

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <br/>
                <div class="row">
                    @include('user._sidebar')
                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            @include('layouts._message')
                            <div class="">

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">ID :</span> {{ $getRecord->order_number }}</label>
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
                                    <label><span style="font-weight: bold;">Status :</span>
                                        @if ($getRecord->status == 0)
                                            Pending
                                        @elseif($getRecord->status == 1)
                                            In Progress
                                        @elseif($getRecord->status == 2)
                                            Delivered
                                        @elseif($getRecord->status == 3)
                                            Completed
                                        @elseif($getRecord->status == 4)
                                            Cancelled
                                        @endif
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Note :</span> {{ $getRecord->note }}</label>
                                </div>

                                <div class="form-group">
                                    <label><span style="font-weight: bold;">Created Date :</span> {{ date('d-m-Y h:i A', strtotime($getRecord->created_at)) }}</label>
                                </div>
                            </div>
                        </div>
                        <hr style="margin: 1rem auto 2rem;">
                        <div class="card-header">
                            <h3 class="card-title">Product Details</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>QTY</th>
                                        <th>Price ($)</th>
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
                                                <img style="height:100px;width: 180px;" src="{{ $getProductImage->getLogo() }}">
                                            </td>
                                            <td style="max-width: 300px;">
                                                <a target="_blank" href="{{ url($item->getProduct->slug) }}">{{ $item->getProduct->title }}</a>
                                                <br>
                                                @if(!empty($item->color_name))
                                                    <b>Color</b>: {{ $item->color_name }} <br/>
                                                @endif
                                                @if(!empty($item->size_name))
                                                    <b>Size</b>: {{ $item->size_name }}
                                                    <br>
                                                @endif
                                                @if($getRecord->status == 3)
                                                    @php
                                                        $getReview = $item->getReview($item->getProduct->id, $getRecord->id);
                                                    @endphp
                                                    @if(!empty($getReview))
                                                        <b>Rating</b>: {{ $getReview->rating }} <br>
                                                        <b>Review</b>: {{ $getReview->review }} <br>
                                                    @else
                                                        <button class="btn btn-primary MakeReview" id="{{ $item->getProduct->id }}" data-order="{{ $getRecord->id }}">Make Review</button>
                                                    @endif

                                                @endif
                                            </td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->price }}</td>
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

<div class="modal fade" id="MakeReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Make Review</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="undefined">&times;</span>
          </button>
        </div>

        <form></form>
        <form action="{{ url('user/make-review') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" id="getProductId" name="product_id" required>
            <input type="hidden" id="getOrderId" name="order_id">

            <div class="modal-body" style="padding: 20px;">
                <div class="form-group" style="display: flex;">
                    <label style="width: 60%;">Stars Vote * </label>
                    <select class="form-control" style="width: 20%;" name="rating" required>
                        <option value="">Select</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <hr style="margin: 1rem auto 2.5rem">
                <div class="form-group">
                    <label>Review * </label>
                    <textarea class="form-control" name="review" required></textarea>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

      </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $('body').delegate('.MakeReview', 'click', function(){
        var product_id = $(this).attr('id');
        var order_id = $(this).attr('data-order');

        $('#getProductId').val(product_id);
        $('#getOrderId').val(order_id);

        $('#MakeReviewModal').modal('show');

    });
</script>
@endsection
