@extends('layouts.homeUser')
@section('css')
    <style>
        .btn-all {
            background-color: #a8741a;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size:
                20px;
            border: none;
            cursor: pointer;
            margin: 12px auto;

        }

        .btn-all:hover {
            background-color: black;
        }
    </style>
@endsection
@section('content')
    <!-- Begin Service Area -->
    <div class="service-area">
        <div class="container">
            <div class="service-nav">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="service-item">
                            <div class="content">
                                <h4>Free Shipping</h4>
                                <p>Free shipping on all order</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="service-item">
                            <div class="content">
                                <h4>Money Return</h4>
                                <p>30 days for free return</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="service-item">
                            <div class="content">
                                <h4>Online Support</h4>
                                <p>Support 24 hours a day</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Area End Here -->

    <!-- Begin Banner Area -->
    <div class="banner-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-6 custom-xxs-col">
                    <div class="banner-item img-hover_effect">
                        <div class="banner-img">
                            <a href="javascrip:void(0)">
                                <img src="{{ asset('assets/client/images/banner/1-1.jpg') }}" alt="Banner">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-6 custom-xxs-col">
                    <div class="banner-item img-hover_effect">
                        <div class="banner-img">
                            <a href="javascrip:void(0)">
                                <img src="{{ asset('assets/client/images/banner/1-2.jpg') }}" alt="Banner">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-6 custom-xxs-col">
                    <div class="banner-item img-hover_effect">
                        <div class="banner-img">
                            <a href="javascrip:void(0)">
                                <img src="{{ asset('assets/client/images/banner/1-3.jpg') }}" alt="Banner">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Area End Here -->

    <!-- Begin Product Area -->
    <div class="product-area ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>New Product</h3>
                        <div class="product-arrow"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="kenne-element-carousel product-slider slider-nav"
                        data-slick-options='{
                            "slidesToShow": 4,
                            "slidesToScroll": 1,
                            "infinite": false,
                            "arrows": true,
                            "dots": false,
                            "spaceBetween": 30,
                            "appendArrows": ".product-arrow"
                            }'
                        data-slick-responsive='[
                            {"breakpoint":992, "settings": {
                            "slidesToShow": 3
                            }},
                            {"breakpoint":768, "settings": {
                            "slidesToShow": 2
                            }},
                            {"breakpoint":575, "settings": {
                            "slidesToShow": 1
                            }}
                        ]'>

                        @foreach ($listProduct as $item)
                            <div class="product-item">
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="{{ route('detail', $item->id) }}">
                                            <img class="primary-img" src="{{ Storage::url($item->image) }}"
                                                alt="Kenne's Product Image">
                                        </a>
                                        <span class="sticker-2">New</span>
                                        <div class="add-actions">
                                            <ul>
                                                <li><a href="cart.html" data-bs-toggle="tooltip" data-placement="right"
                                                        title="Add To cart"><i class="ion-bag"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-desc_info">
                                            <h3 class="product-name"><a
                                                    href="{{ route('detail', $item->id) }}">{{ substr($item->name, 0, $longString) }}...</a>
                                            </h3>
                                            <div class="price-box">
                                                <span
                                                    class="new-price">{{ number_format($item->sale_price, 0, '', '.') }}</span>
                                                <span class="old-price">{{ number_format($item->price, 0, '', '.') }}</span>
                                            </div>
                                            <div class="rating-box">
                                                <ul>
                                                    <li><i class="ion-ios-star"></i></li>
                                                    <li><i class="ion-ios-star"></i></li>
                                                    <li><i class="ion-ios-star"></i></li>
                                                    <li class="silver-color"><i class="ion-ios-star-half"></i></li>
                                                    <li class="silver-color"><i class="ion-ios-star-outline"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button class="btn-all">Xem tất cả</button>
        </div>
    </div>
    <!-- Product Area End Here -->

    <!-- Begin Product Tab Area -->
    <div class="product-tab_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>Hot Product</h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="tab-content kenne-tab_content">
                        <div id="bag" class="tab-pane active show" role="tabpanel">
                            <div class="kenne-element-carousel product-tab_slider slider-nav product-tab_arrow"
                                data-slick-options='{
                                        "slidesToShow": 4,
                                        "slidesToScroll": 1,
                                        "infinite": false,
                                        "arrows": true,
                                        "dots": false,
                                        "spaceBetween": 30
                                        }'
                                data-slick-responsive='[
                                        {"breakpoint":992, "settings": {
                                        "slidesToShow": 3
                                        }},
                                        {"breakpoint":768, "settings": {
                                        "slidesToShow": 2
                                        }},
                                        {"breakpoint":575, "settings": {
                                        "slidesToShow": 1
                                        }}
                                    ]'>

                                @foreach ($listProduct as $item)
                                    <div class="product-item">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ route('detail', $item->id) }}">
                                                    <img class="primary-img" src="{{ Storage::url($item->image) }}"
                                                        alt="Kenne's Product Image">
                                                </a>
                                                <span class="sticker-2">Hot</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a href="cart.html" data-bs-toggle="tooltip"
                                                                data-placement="right" title="Add To cart"><i
                                                                    class="ion-bag"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-desc_info">
                                                    <h3 class="product-name"><a
                                                            href="{{ route('detail', $item->id) }}">{{ substr($item->name, 0, $longString) }}...</a>
                                                    </h3>
                                                    <div class="price-box">
                                                        <span
                                                            class="new-price">{{ number_format($item->sale_price, 0, '', '.') }}</span>
                                                        <span
                                                            class="old-price">{{ number_format($item->price, 0, '', '.') }}</span>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li class="silver-color"><i class="ion-ios-star-half"></i>
                                                            </li>
                                                            <li class="silver-color"><i class="ion-ios-star-outline"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn-all">Xem tất cả</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Tab Area End Here -->

    <!-- Begin Product Tab Area -->
    <div class="product-tab_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>Sale Product</h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="tab-content kenne-tab_content">
                        <div id="bag" class="tab-pane active show" role="tabpanel">
                            <div class="kenne-element-carousel product-tab_slider slider-nav product-tab_arrow"
                                data-slick-options='{
                                                    "slidesToShow": 4,
                                                    "slidesToScroll": 1,
                                                    "infinite": false,
                                                    "arrows": true,
                                                    "dots": false,
                                                    "spaceBetween": 30
                                                    }'
                                data-slick-responsive='[
                                                    {"breakpoint":992, "settings": {
                                                    "slidesToShow": 3
                                                    }},
                                                    {"breakpoint":768, "settings": {
                                                    "slidesToShow": 2
                                                    }},
                                                    {"breakpoint":575, "settings": {
                                                    "slidesToShow": 1
                                                    }}
                                                ]'>

                                @foreach ($listProduct as $item)
                                    <div class="product-item">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ route('detail', $item->id) }}">
                                                    <img class="primary-img" src="{{ Storage::url($item->image) }}"
                                                        alt="Kenne's Product Image">
                                                </a>
                                                <span class="sticker">Sale</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a href="cart.html" data-bs-toggle="tooltip"
                                                                data-placement="right" title="Add To cart"><i
                                                                    class="ion-bag"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-desc_info">
                                                    <h3 class="product-name"><a
                                                            href="{{ route('detail', $item->id) }}">{{ substr($item->name, 0, $longString) }}...</a>
                                                    </h3>
                                                    <div class="price-box">
                                                        <span
                                                            class="new-price">{{ number_format($item->sale_price, 0, '', '.') }}</span>
                                                        <span
                                                            class="old-price">{{ number_format($item->price, 0, '', '.') }}</span>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li class="silver-color"><i class="ion-ios-star-half"></i>
                                                            </li>
                                                            <li class="silver-color"><i class="ion-ios-star-outline"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn-all">Xem tất cả</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Tab Area End Here -->

    <!-- Begin Product Tab Area -->
    <div class="product-tab_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>All Product</h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="tab-content kenne-tab_content">
                        <div id="bag" class="tab-pane active show" role="tabpanel">
                            <div class="kenne-element-carousel product-tab_slider slider-nav product-tab_arrow"
                                data-slick-options='{
                                        "slidesToShow": 4,
                                        "slidesToScroll": 1,
                                        "infinite": false,
                                        "arrows": true,
                                        "dots": false,
                                        "spaceBetween": 30
                                        }'
                                data-slick-responsive='[
                                        {"breakpoint":992, "settings": {
                                        "slidesToShow": 3
                                        }},
                                        {"breakpoint":768, "settings": {
                                        "slidesToShow": 2
                                        }},
                                        {"breakpoint":575, "settings": {
                                        "slidesToShow": 1
                                        }}
                                    ]'>

                                @foreach ($listProduct as $item)
                                    <div class="product-item">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ route('detail', $item->id) }}">
                                                    <img class="primary-img" src="{{ Storage::url($item->image) }}"
                                                        alt="Kenne's Product Image">
                                                </a>
                                                <span class="sticker-2">
                                                    Favourite</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a href="cart.html" data-bs-toggle="tooltip"
                                                                data-placement="right" title="Add To cart"><i
                                                                    class="ion-bag"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-desc_info">
                                                    <h3 class="product-name"><a
                                                            href="{{ route('detail', $item->id) }}">{{ substr($item->name, 0, $longString) }}...</a>
                                                    </h3>
                                                    <div class="price-box">
                                                        <span
                                                            class="new-price">{{ number_format($item->sale_price, 0, '', '.') }}</span>
                                                        <span
                                                            class="old-price">{{ number_format($item->price, 0, '', '.') }}</span>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li><i class="ion-ios-star"></i></li>
                                                            <li class="silver-color"><i class="ion-ios-star-half"></i>
                                                            </li>
                                                            <li class="silver-color"><i class="ion-ios-star-outline"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn-all">Xem tất cả</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Tab Area End Here -->
@endsection
@section('js')
@endsection
