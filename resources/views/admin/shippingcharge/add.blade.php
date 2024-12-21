@extends('admin.layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add New Shipping Charge</h3>
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
                                    <label>Shipping Charge Name <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" required value="{{ old('name') }}" name="name" placeholder="Shipping Charge Name">
                                </div>

                                <div class="form-group">
                                    <label>Price <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" required value="{{ old('price') }}" name="price" placeholder="Price">
                                </div>

                                <div class="form-group">
                                    <label>Status <span style="color: red">*</span></label>
                                    <select class="form-control" name="status">
                                        <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Active</option>
                                        <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">InActive</option>
                                    </select>
                                </div>

                            </div>
                            <div class="card-footer"> <button type="submit" class="btn btn-primary">Submit</button> </div>
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
