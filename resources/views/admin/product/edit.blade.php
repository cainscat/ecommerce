@extends('admin.layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Product</h3>
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

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>Title </strong><span style="color: red">*</span></label>
                                            <input type="text" class="form-control" required value="{{ old('title', $product->title) }}" name="title" placeholder="Title">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>SKU </strong><span style="color: red">*</span></label>
                                            <input type="text" class="form-control" required value="{{ old('sku', $product->sku) }}" name="sku" placeholder="SKU">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>Category </strong><span style="color: red">*</span></label>
                                            <select name="category_id" required id="ChangeCategory" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($getCategory as $category)
                                                    <option {{ ($product->category_id == $category->id) ? 'selected' : '' }}
                                                        value="{{ $category->id }}">{{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>Sub Category </strong><span style="color: red">*</span></label>
                                            <select name="sub_category_id" required id="getSubCategory" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($getSubCategory as $subcategory)
                                                    <option {{ ($product->sub_category_id == $subcategory->id) ? 'selected' : '' }}
                                                        value="{{ $subcategory->id }}">{{ $subcategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>Brand </strong><span style="color: red">*</span></label>
                                            <select name="brand_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($getBrand as $brand)
                                                    <option {{ ($product->brand_id == $brand->id) ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><strong>Color </strong><span style="color: red">*</span></label>
                                            @foreach ($getColor as $color)
                                                @php
                                                    $checked = '';
                                                @endphp
                                                @foreach ($product->getColor as $pcolor)
                                                    @if ($pcolor->color_id == $color->id)
                                                        @php
                                                            $checked = 'checked';
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <div>
                                                    <label><input {{ $checked }} type="checkbox" name="color_id[]" value="{{ $color->id }}">{{ $color->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>Price ($) </strong><span style="color: red">*</span></label>
                                            <input type="text" class="form-control" required value="{{ !empty($product->price) ? $product->price : '' }}" name="price" placeholder="Price">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>Old Price ($) </strong><span style="color: red">*</span></label>
                                            <input type="text" class="form-control" required value="{{ !empty($product->old_price) ? $product->old_price : '' }}" name="old_price" placeholder="Old Price">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><strong>Size </strong><span style="color: red">*</span></label>
                                            <div>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Price ($)</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="AppendSize">
                                                        @php
                                                            $i_s = 1;
                                                        @endphp
                                                        @foreach ($product->getSize as $size)
                                                            <tr id="DeleteSize{{ $i_s }}">
                                                                <td>
                                                                    <input type="text" value="{{ $size->name }}" name="size[{{ $i_s }}][name]" placeholder="Name" class="form-control">
                                                                </td>
                                                                <td>
                                                                    <input type="text" value="{{ $size->price }}" name="size[{{ $i_s }}][price]" placeholder="Price" class="form-control">
                                                                </td>
                                                                <td style="width: 100px;">
                                                                    <button type="button" id="{{ $i_s }}" class="btn btn-danger DeleteSize">Delete</button>                                                                </td>
                                                            </tr>
                                                            @php
                                                                $i_s++;
                                                            @endphp
                                                        @endforeach
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="size[100][name]" placeholder="Name" class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="size[100][price]" placeholder="Price" class="form-control">
                                                            </td>
                                                            <td style="width: 100px;">
                                                                <button type="button" class="btn btn-primary AddSize">Add</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><strong>Image</strong> <span style="color: red"></span></label>
                                            <input type="file" class="form-control" style="padding: 5px;" name="image[]" multiple accept="image/*">
                                        </div>
                                    </div>
                                </div>

                                @if (!empty($product->getImage->count()))
                                        <div class="row">
                                            @foreach ($product->getImage as $image)
                                                @if (!empty($image->getLogo()))
                                                    <div class="col-md-1 mt-3" style="text-align: center;">
                                                        <img style="width: 100%; height:70%;" src="{{ $image->getLogo() }}">
                                                        <a onclick="return confirm('Are you sure want to delete?');" href="{{ url('admin/product/image_delete/'.$image->id) }}" style="margin-top: 5px;" class="btn btn-danger btn-sm">Delete</a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                @endif

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><strong>Short Description </strong><span style="color: red">*</span></label>
                                            <textarea name="short_description" class="form-control" placeholder="Short Description">{{ $product->short_description }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><strong>Description </strong><span style="color: red">*</span></label>
                                            <textarea name="description" id="summernote" class="form-control editor" placeholder="Description">{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><strong>Additional Information </strong><span style="color: red">*</span></label>
                                            <textarea name="additional_information"  class="form-control editor" placeholder="Additional Information">{{ $product->additional_information }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><strong>Shipping Returns </strong><span style="color: red">*</span></label>
                                            <textarea name="shipping_returns"  class="form-control editor" placeholder="Shipping Returns">{{ $product->shipping_returns }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <hr/>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><strong>Status </strong><span style="color: red">*</span></label>
                                            <select class="form-control" name="status">
                                                <option {{ ($product->status == 0) ? 'selected' : '' }} value="0">Active</option>
                                                <option {{ ($product->status == 1) ? 'selected' : '' }} value="1">InActive</option>
                                            </select>
                                        </div>
                                    </div>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

    <script type="text/javascript">
        //Text editor
        $(document).ready(function() {
            $('.editor').summernote({
                placeholder: 'Enter here...',
                tabsize: 2,
                height: 100
            });
        });

        //Add,DeleteSize-begin
        var i = 101;
        $('body').delegate('.AddSize', 'click', function(){
            var html = '<tr id="DeleteSize'+i+'">\n\
                            <td>\n\
                                <input type="text" name="size['+i+'][name]" placeholder="Name" class="form-control">\n\
                            </td>\n\
                            <td>\n\
                                <input type="text" name="size['+i+'][price]" placeholder="Price" class="form-control">\n\
                            </td>\n\
                            <td>\n\
                                <button type="button" id="'+i+'" class="btn btn-danger DeleteSize">Delete</button>\n\
                            </td>\n\
                        </tr>';
            i++;
            $('#AppendSize').append(html);
        });

        $('body').delegate('.DeleteSize', 'click', function(){
            var id = $(this).attr('id');
            $('#DeleteSize'+id).remove();
        });
        //endAdd,deleteSize

        //get subcategory when choose category
        $('body').delegate('#ChangeCategory', 'change', function(e){
            var id = $(this).val();

            $.ajax({
                type: "POST",
                url: "{{ url('admin/get_sub_category') }}",
                data: {
                    "id" : id,
                    "_token": "{{ csrf_token() }}"
                },
                dataType : "json",
                success: function(data){
                    $('#getSubCategory').html(data.html);
                },
                error: function(data){

                }
            });
        });

    </script>
@endsection
