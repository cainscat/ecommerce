@extends('admin.layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add New Partner</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form action="" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Image <span style="color: red">*</span></label>
                                    <input type="file" class="form-control" required name="image_name">
                                </div>

                                <div class="form-group">
                                    <label>Link <span style="color: red"></span></label>
                                    <input type="text" class="form-control" required value="{{ old('button_link') }}" name="button_link" placeholder="Link">
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
