@extends('admin.layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Page</h3>
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
                                    <label>Name <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->name }}" name="name">
                                </div>

                                <div class="form-group mt-2">
                                    <label>Title <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->title }}" name="title">
                                </div>

                                <div class="form-group mt-2">
                                    <label>Image <span style="color: red"></span></label>
                                    <input type="file" class="form-control" name="image">
                                    @if(!empty($getRecord->getImage()))
                                        <img style="width:200px; height: 120px;" src="{{ $getRecord->getImage() }}">
                                    @endif
                                </div>

                                <div class="form-group mt-2">
                                    <label>Description <span style="color: red"></span></label>
                                    <textarea id="summernote" name="description" class="form-control editor" placeholder="Description"></textarea>
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
