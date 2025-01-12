@extends('admin.layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Home Setting</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    @include('admin.layouts._message')
                    <div class="card card-primary">
                        <form action="" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Trendy Product Title <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->trendy_product_title }}" name="trendy_product_title">
                                </div>

                                <div class="form-group">
                                    <label>Shop Category Title <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->shop_category_title }}" name="shop_category_title">
                                </div>

                                <div class="form-group">
                                    <label>Recent Arrival Title <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->recent_arrival_title }}" name="recent_arrival_title">
                                </div>

                                <div class="form-group">
                                    <label>Blog Title <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->blog_title }}" name="blog_title">
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label>Paymet Delivery Title <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->payment_delivery_title }}" name="payment_delivery_title">
                                </div>

                                <div class="form-group">
                                    <label>Paymet Delivery Description <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->payment_delivery_description }}" name="payment_delivery_description">
                                </div>

                                <div class="form-group">
                                    <label>Paymet Delivery Image <span style="color: red"></span></label>
                                    <input type="file" class="form-control" name="payment_delivery_image">
                                    @if(!empty($getRecord->getPaymentImage()))
                                        <img style="width: 100px;" src="{{ $getRecord->getPaymentImage() }}">
                                    @endif
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label>Refund Title <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->refund_title }}" name="refund_title">
                                </div>

                                <div class="form-group">
                                    <label>Refund Description <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->refund_description }}" name="refund_description">
                                </div>

                                <div class="form-group">
                                    <label>Refund Image <span style="color: red"></span></label>
                                    <input type="file" class="form-control" name="refund_image">
                                    @if(!empty($getRecord->getRefundImage()))
                                        <img style="width: 100px;" src="{{ $getRecord->getRefundImage() }}">
                                    @endif
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label>Support Title <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->support_title }}" name="support_title">
                                </div>

                                <div class="form-group">
                                    <label>Support Description <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->support_description }}" name="support_description">
                                </div>

                                <div class="form-group">
                                    <label>Support Image <span style="color: red"></span></label>
                                    <input type="file" class="form-control" name="support_image">
                                    @if(!empty($getRecord->getSupportImage()))
                                        <img style="width: 100px;" src="{{ $getRecord->getSupportImage() }}">
                                    @endif
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label>SignUp Title <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->signup_title }}" name="signup_title">
                                </div>

                                <div class="form-group">
                                    <label>SignUp Description <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->signup_description }}" name="signup_description">
                                </div>

                                <div class="form-group">
                                    <label>SignUp Image <span style="color: red"></span></label>
                                    <input type="file" class="form-control" name="signup_image">
                                    @if(!empty($getRecord->getSignupImage()))
                                        <img style="width: 100px;" src="{{ $getRecord->getSignupImage() }}">
                                    @endif
                                </div>


                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

<script>
    //Text editor
    $(document).ready(function() {
            $('.editor').summernote({
                placeholder: 'Enter here...',
                tabsize: 2,
                height: 100
            });
        });
</script>
@endsection
