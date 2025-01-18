@extends('admin.layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Payment Setting</h3>
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
                                    <label style="display: block;">Paypal (On/Off)<span style="color: red"></span></label>
                                    <input type="checkbox" {{ !empty($getRecord->is_paypal) ? 'checked' : '' }} name="is_paypal">
                                </div>

                                <div class="form-group">
                                    <label>Paypal Email ID <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->paypal_id }}" name="paypal_id">
                                </div>

                                <div class="form-group">
                                    <label>Paypal Status <span style="color: red"></span></label>
                                    <select class="form-control" name="paypal_status">
                                        <option {{ ($getRecord->paypal_status == 'sanbox') ? 'selected' : '' }} value="sandbox">Sandbox</option>
                                        <option {{ ($getRecord->paypal_status == 'live') ? 'selected' : '' }} value="live">Live</option>
                                    </select>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label style="display: block;">Stripe (On/Off)<span style="color: red"></span></label>
                                    <input type="checkbox" {{ !empty($getRecord->is_stripe) ? 'checked' : '' }} name="is_stripe">
                                </div>

                                <div class="form-group">
                                    <label>Stripe Public Key <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->stripe_public_key }}" name="stripe_public_key">
                                </div>

                                <div class="form-group">
                                    <label>Stripe Secret Key <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->stripe_secret_key }}" name="stripe_secret_key">
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label style="display: block;">Cash on Delivery (On/Off) <span style="color: red"></span></label>
                                    <input type="checkbox" {{ !empty($getRecord->is_cash_delivery) ? 'checked' : '' }} name="is_cash_delivery">
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
