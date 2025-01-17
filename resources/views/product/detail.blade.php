@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/plugins/nouislider/nouislider.css') }}">
@endsection
@section('content')

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url($getProduct->getCategory->slug) }}">{{ $getProduct->getCategory->name }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url($getProduct->getCategory->slug.'/'.$getProduct->getSubCategory->slug) }}">{{ $getProduct->getSubCategory->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $getProduct->title }}</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <div class="product-details-top mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery">
                            <figure class="product-main-image">
                                @php
                                    $getProductImage = $getProduct->getImageSingle($getProduct->id);
                                @endphp

                                @if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                    <img id="product-zoom" src="{{ $getProductImage->getLogo() }}" data-zoom-image="{{ $getProductImage->getLogo() }}" alt="product image">
                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>
                                @endif

                            </figure>

                            <div id="product-zoom-gallery" class="product-image-gallery">

                                @foreach ($getProduct->getImage as $image)
                                    <a class="product-gallery-item" href="#" data-image="{{ $image->getLogo() }}" data-zoom-image="{{ $image->getLogo() }}">
                                        <img src="{{ $image->getLogo() }}" alt="product side" style="height: 100%;">
                                    </a>
                                @endforeach

                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        @include('layouts._message')
                        <div class="product-details">
                            <h1 class="product-title">{{ $getProduct->title }}</h1>

                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width:{{ $getProduct->getReviewRating($getProduct->id) }}%;"></div>
                                </div>
                                <a class="ratings-text" href="#product-review-link" id="review-link">( {{ $getProduct->getTotalReview() }} Reviews )</a>
                            </div>

                            <div class="product-price">
                                $<span id="getTotalPrice">{{ number_format($getProduct->price, 2) }}</span>
                            </div>

                            <div class="product-content">
                                <p>{{ $getProduct->short_description }}</p>
                            </div>

                            <form id="form1"></form>
                            <form action="{{ url('product/add-to-cart') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="product_id" value="{{ $getProduct->id }}">
                            @if (!empty($getProduct->getColor->count()))
                            <div class="details-filter-row details-row-size">
                                <label for="size">Color:</label>
                                <div class="select-custom" style="width: min-content;">
                                    <select name="color_id" id="color_id" required class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($getProduct->getColor as $color)
                                            <option value="{{ $color->getColor->id }}">{{ $color->getColor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            @if (!empty($getProduct->getSize->count()))
                            <div class="details-filter-row details-row-size">
                                <label for="size">Size:</label>
                                <div class="select-custom" style="width: min-content;">
                                    <select name="size_id" id="size" required class="form-control getSizePrice">
                                        <option data-price="0" value="">Select</option>
                                        @foreach ($getProduct->getSize as $size)
                                            <option data-price="{{ !empty($size->price) ? $size->price : '0' }}" value="{{ $size->id }}">
                                                {{ $size->name }}
                                                @if(!empty($size->price))
                                                    (${{ number_format($size->price, 2) }})
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="details-filter-row details-row-size">
                                <label for="qty">Qty:</label>
                                <div class="product-details-quantity">
                                    <input type="number" id="qty" class="form-control" value="1" min="1" max="100" name="qty" required step="1" data-decimals="0" required>
                                </div>
                            </div>

                            <div class="product-details-action">
                                <button type="submit" style="background: #c96; color:#fff;" class="btn-product btn-cart">
                                    <span>add to cart</span>
                                </button>

                                <div class="details-action-wrapper">
                                    @if(!empty(Auth::check()))

                                        <a href="javascript:;" id="{{ $getProduct->id }}" class="add_to_wishlist add_to_wishlist{{ $getProduct->id }} {{ !empty($getProduct->checkWishlist($getProduct->id)) ? 'btn-wishlist-add' : '' }} btn-product btn-wishlist" title="Wishlist">
                                            <span>
                                                Add to Wishlist
                                            </span>
                                        </a>
                                    @else
                                        <a href="#signin-modal" data-toggle="modal" class="btn-product btn-wishlist" title="Wishlist">
                                            <span>
                                                Add to Wishlist
                                            </span>
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </form>

                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>Category:</span>
                                    <a href="{{ url($getProduct->getCategory->slug) }}">{{ $getProduct->getCategory->name }}</a>,
                                    <a href="{{ url($getProduct->getCategory->slug.'/'.$getProduct->getSubCategory->slug) }}">{{ $getProduct->getSubCategory->name }}</a>
                                </div>

                                {{-- <div class="social-icons social-icons-sm">
                                    <span class="social-label">Share:</span>
                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                </div> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-details-tab product-details-extended">
            <div class="container">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews ({{ $getProduct->getTotalReview() }})</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                        <div class="container" style="margin-top: 20px;">
                            {!! $getProduct->description !!}
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                    <div class="product-desc-content">
                        <div class="container" style="margin-top: 20px;">
                            {!! $getProduct->additional_information !!}
                        </div>
                    </div>>
                </div>
                <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                    <div class="product-desc-content">
                        <div class="container" style="margin-top: 20px;">
                            {!! $getProduct->shipping_returns !!}
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                    <div class="reviews">
                        <div class="container" style="margin-top: 20px;">
                            <h3>Reviews ({{ $getProduct->getTotalReview() }})</h3>
                            @foreach ($getReviewProduct as $review)
                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">{{ $review->name }}</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: {{ $review->getPercent() }}%;"></div>
                                                </div>
                                            </div>
                                            <span class="review-date">
                                                {{ Carbon\Carbon::parse($review->created_at)->diffForHumans() }}
                                            </span>
                                        </div>
                                        <div class="col">
                                            <h4>{{ $review->review }}</h4>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {!! $getReviewProduct->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <h2 class="title text-center mb-4">You May Also Like</h2>
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>

                @foreach ($getRelatedProduct as $value)
                @php
                    $getProductImage = $value->getImageSingle($value->id);
                @endphp
                    <div class="product product-7">
                        <figure class="product-media">
                            <a href="{{ url($value->slug) }}">
                                @if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                    <img style="height:280px;width:100%;object-fit:fill;" src="{{ $getProductImage->getLogo() }}" alt="{{ $value->title }}" class="product-image">
                                @endif
                            </a>

                            <div class="product-action-vertical">
                                @if(!empty(Auth::check()))
                                    <a href="javascript:;" id="{{ $value->id }}" data-toggle="modal" class="add_to_wishlist add_to_wishlist{{ $value->id }} btn-product-icon btn-wishlist btn-expandable {{ !empty($value->checkWishlist($value->id)) ? 'btn-wishlist-add' : '' }}" title="Wishlist">
                                        <span>
                                            Add to Wishlist
                                        </span>
                                    </a>
                                @else
                                    <a href="#signin-modal" data-toggle="modal" class="btn-product-icon btn-wishlist btn-expandable" title="Wishlist">
                                        <span>
                                            Add to Wishlist
                                        </span>
                                    </a>
                                @endif
                            </div>
                        </figure>

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="{{ url($value->category_slug.'/'.$value->sub_category_slug) }}">{{ $value->sub_category_name }}</a>
                            </div>
                            <h3 class="product-title"><a href="{{ url($value->slug) }}">{{ $value->title }}</a></h3>
                            <div class="product-price">
                                ${{ number_format($value->price, 2) }}
                            </div>
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: {{ $value->getReviewRating($value->id) }}%;"></div>
                                </div>
                                <span class="ratings-text">( {{ $value->getTotalReview() }} Reviews )</span>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</main>

@endsection

@section('script')
    <script src="{{ url('assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ url('assets/js/jquery.elevateZoom.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ url('assets/js/jquery.magnific-popup.min.js') }}"></script>

    <script>
        $('.getSizePrice').change(function() {
            var prduct_price = '{{ $getProduct->price }}';
            var price = $('option:selected', this).attr('data-price');
            var total = parseFloat(prduct_price) + parseFloat(price);
            $('#getTotalPrice').html(total.toFixed(2));

        });
    </script>

@endsection
