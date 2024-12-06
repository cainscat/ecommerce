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
                    <div class="card card-primary">
                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" required value="{{ old('title', $product->title) }}" name="title" placeholder="Title">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>SKU <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" required value="{{ old('sku', $product->sku) }}" name="sku" placeholder="SKU">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category <span style="color: red">*</span></label>
                                            <select name="category_id" class="form-control">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sub Category <span style="color: red">*</span></label>
                                            <select name="sub_category_id" class="form-control">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Brand <span style="color: red">*</span></label>
                                            <select name="brand_id" class="form-control">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Color <span style="color: red">*</span></label>
                                            <div>
                                                <label><input type="checkbox" name="color_id[]">Red</label>
                                            </div>
                                            <div>
                                                <label><input type="checkbox" name="color_id[]">White</label>
                                            </div>
                                            <div>
                                                <label><input type="checkbox" name="color_id[]">Green</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Price ($) <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" required value="" name="price" placeholder="Price">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Old Price ($) <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" required value="" name="old_price" placeholder="Old Price">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Size <span style="color: red">*</span></label>
                                            <div>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Price ($)</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="" class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="" class="form-control">
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary">Add</button>
                                                                <button type="button" class="btn btn-danger">Delete</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="" class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="" class="form-control">
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger">Delete</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="" class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="" class="form-control">
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger">Delete</button>
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
                                            <label>Short Description <span style="color: red">*</span></label>
                                            <textarea name="short_description" class="form-control" placeholder="Short Description"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description <span style="color: red">*</span></label>
                                            <textarea name="description" class="form-control" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Additional Information <span style="color: red">*</span></label>
                                            <textarea name="additional_information" class="form-control" placeholder="Additional Information"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Shipping Returns <span style="color: red">*</span></label>
                                            <textarea name="shipping_returns" class="form-control" placeholder="Shipping Returns"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <hr/>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Status <span style="color: red">*</span></label>
                                            <select class="form-control" name="status">
                                                <option {{ (old('status') == 0) ? 'selected' : '' }} value="1">InActive</option>
                                                <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Active</option>
                                            </select>
                                        </div>
                                    </div>
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
