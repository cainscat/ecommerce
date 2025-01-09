@extends('admin.layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Blog</h3>
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
                                    <label>Blog Title <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" required value="{{ $getRecord->title }}" name="title" placeholder="Title">
                                    <div style="color: red">{{ $errors->first('title') }}</div>
                                </div>

                                <div class="form-group">
                                    <label>Blog Category <span style="color: red">*</span></label>
                                    <select class="form-control" name="blog_category_id" required>
                                        <option value="">Select</option>
                                        @foreach($getCategory as $category)
                                        <option {{ ($getRecord->blog_category_id) == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image_name">
                                    @if(!empty($getRecord->getImage()))
                                        <img style="width: 200px; height:80px;" src="{{ $getRecord->getImage() }}">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Description <span style="color: red">*</span></label>
                                    <textarea class="form-control editor" name="description">{{ $getRecord->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Status <span style="color: red">*</span></label>
                                    <select class="form-control" name="status">
                                        <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Active</option>
                                        <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">InActive</option>
                                    </select>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label>Meta title <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" required value="{{ $getRecord->meta_title }}" name="meta_title" placeholder="Meta Title">
                                </div>

                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <textarea class="form-control" placeholder="Meta Description" name="meta_description">{{ $getRecord->meta_description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Meta Keywords</label>
                                    <input type="text" class="form-control" value="{{ $getRecord->meta_keywords }}" name="meta_keywords" placeholder="Meta Keywords">
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
