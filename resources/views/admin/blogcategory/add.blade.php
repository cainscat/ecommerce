@extends('admin.layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add New Blog Category</h3>
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
                                    <label>Blog Category Name <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" required value="{{ old('name') }}" name="name" placeholder="Category Name">
                                </div>

                                <div class="form-group">
                                    <label>Slug <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" required value="{{ old('slug') }}" name="slug" placeholder="Slug Ex. URL">
                                    <div style="color: red">{{ $errors->first('slug') }}</div>
                                </div>

                                <div class="form-group">
                                    <label>Status <span style="color: red">*</span></label>
                                    <select class="form-control" name="status">
                                        <option {{ (old('status') == 0) ? 'selected' : '' }} value="1">InActive</option>
                                        <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Active</option>
                                    </select>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label>Meta title <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" required value="{{ old('meta_title') }}" name="meta_title" placeholder="Meta Title">
                                </div>

                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <textarea class="form-control" placeholder="Meta Description" name="meta_description">{{ old('meta_description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Meta Keywords</label>
                                    <input type="text" class="form-control" value="{{ old('meta_keywords') }}" name="meta_keywords" placeholder="Meta Keywords">
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
