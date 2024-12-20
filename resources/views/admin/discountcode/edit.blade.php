@extends('admin.layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Discount Code</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Discount Code Name <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" required value="{{ old('name', $getRecord->name) }}" name="name" placeholder="Discount Code Name">
                                </div>

                                <div class="form-group">
                                    <label>Type <span style="color: red">*</span></label>
                                    <select class="form-control" name="type">
                                        <option {{ (old('type', $getRecord->type) == 'Amount') ? 'selected' : '' }} value="Amount">Amount</option>
                                        <option {{ (old('type', $getRecord->type) == 'Percent') ? 'selected' : '' }} value="Percent">Percent</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Percent / Amount <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" required value="{{ old('percent_amount', $getRecord->percent_amount) }}" name="percent_amount" placeholder="Percent / Amount">
                                </div>

                                <div class="form-group">
                                    <label>Exprie Date <span style="color: red">*</span></label>
                                    <input type="date" class="form-control" required value="{{ old('expire_date', $getRecord->expire_date) }}" name="expire_date">
                                </div>


                                <div class="form-group">
                                    <label>Status <span style="color: red">*</span></label>
                                    <select class="form-control" name="status">
                                        <option {{ (old('status', $getRecord->status) == 0) ? 'selected' : '' }} value="0">Active</option>
                                        <option {{ (old('status', $getRecord->status) == 1) ? 'selected' : '' }} value="1">InActive</option>
                                    </select>
                                </div>

                            </div>
                            <div class="card-footer"> <button type="submit" class="btn btn-primary">Update</button> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection
