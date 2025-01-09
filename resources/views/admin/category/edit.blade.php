@extends('admin.layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Category</h3>
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
                                    <label>Category Name <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" required value="{{ old('name', $getRecord->name) }}" name="name" placeholder="Category Name">
                                </div>

                                <div class="form-group">
                                    <label>Slug <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" required value="{{ old('slug', $getRecord->slug) }}" name="slug" placeholder="Slug Ex. URL">
                                    <div style="color: red">{{ $errors->first('slug') }}</div>
                                </div>

                                <div class="form-group">
                                    <label>Status <span style="color: red">*</span></label>
                                    <select class="form-control" name="status">
                                        <option {{ (old('status', $getRecord->status) == 0) ? 'selected' : '' }} value="0">Active</option>
                                        <option {{ (old('status', $getRecord->status) == 1) ? 'selected' : '' }} value="1">InActive</option>
                                    </select>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label>Image <span style="color: red"></span></label>
                                    <input type="file" class="form-control" name="image_name">
                                    @if(!empty($getRecord->getImage()))
                                        <img style="width:200px; height: 100px" src="{{ $getRecord->getImage() }}">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Button Name <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ old('button_name', $getRecord->button_name) }}" name="button_name" placeholder="Button Name">
                                </div>

                                <div class="form-group">
                                    <label style="display: block;">Home Screen <span style="color: red"></span></label>
                                    <input type="checkbox" {{ !empty($getRecord->is_home) ? 'checked' : '' }} name="is_home">
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label>Meta title <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" required value="{{ old('meta_title', $getRecord->meta_title) }}" name="meta_title" placeholder="Meta Title">
                                </div>

                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <textarea class="form-control" placeholder="Meta Description" name="meta_description">{{ old('meta_description', $getRecord->meta_description) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Meta Keywords</label>
                                    <input type="text" class="form-control" value="{{ old('meta_keywords', $getRecord->meta_keywords) }}" name="meta_keywords" placeholder="Meta Keywords">
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
