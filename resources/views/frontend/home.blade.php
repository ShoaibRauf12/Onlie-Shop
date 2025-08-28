@extends('frontend.layout.app')
@section('title', 'Home Page')
@section('content')

    <section id="billboard" class="position-relative overflow-hidden bg-light-blue">
        <div class="swiper main-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-6">
                                <div class="banner-content">
                                    <h1 class="display-2 text-uppercase text-dark pb-5">Your Products Are Great.</h1>
                                    <a href="shop.html" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop
                                        Product</a>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="image-holder">
                                    <img src="images/banner-image.png" alt="banner">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row d-flex flex-wrap align-items-center">
                            <div class="col-md-6">
                                <div class="banner-content">
                                    <h1 class="display-2 text-uppercase text-dark pb-5">Technology Hack You Won't Get</h1>
                                    <a href="shop.html" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop
                                        Product</a>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="image-holder">
                                    <img src="images/banner-image.png" alt="banner">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-icon swiper-arrow swiper-arrow-prev">
            <svg class="chevron-left">
                <use xlink:href="#chevron-left" />
            </svg>
        </div>
        <div class="swiper-icon swiper-arrow swiper-arrow-next">
            <svg class="chevron-right">
                <use xlink:href="#chevron-right" />
            </svg>
        </div>
    </section>

    {{-- Categories --}}
    <section id="categories" class="padding-large">
        <div class="container">
            <div class="row">

                @if (getCategories()->isNotEmpty())
                    <h2>{{ Str::upper(__('Categories')) }}</h2>
                    @foreach (getCategories() as $category)
                        <div class="col-lg-3 cold-md-6">
                            <div class="card shadow my-2 bg-body rounded">
                                <div class="card-body category-body py-2">
                                    <div class="row">
                                        <div class="col-md-3">
                                            @if (!empty($category->image))
                                                <img class="img-fluid"
                                                    src="{{ asset('admin_assets/images/category_images/' . $category->image) }}"
                                                    alt="">
                                            @endif
                                        </div>
                                        <div class="col-md-9">
                                            <a href="#" class="py-4 w-100 d-block">{{ $category->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif

            </div>
        </div>
    </section>

    {{-- Featured Product --}}
    <section id="featured-products" class="product-store position-relative padding-large no-padding-top">
        <div class="container">
            <div class="row">
                <div class="display-header d-flex justify-content-between pb-3">
                    <h2 class="display-7 text-dark text-uppercase">{{ Str::upper(__('Featured Products')) }}</h2>
                    <div class="btn-right">
                        <a href="{{route('shop')}}" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                    </div>
                </div>
                <div class="swiper product-swiper">
                    <div class="swiper-wrapper">
                        @if (!empty($featured_products))
                            @foreach ($featured_products as $f_product)
                                <div class="swiper-slide">
                                    <div class="product-card position-relative shadow my-2 bg-body rounded p-4">
                                        <div class="image-holder">
                                            @if ($f_product->product_images->isNotEmpty())
                                                <img src="{{ asset('admin_assets/images/product_images/' . $f_product->product_images->last()->image) }}"
                                                    alt="product-item" class="img-fluid w-100" style="height:300px">
                                            @endif
                                        </div>
                                        <div class="cart-concern position-absolute">
                                            <div class="cart-button d-flex">
                                                <a href="#" class="btn btn-black">Add to Cart<svg
                                                        class="cart-outline">
                                                        <use xlink:href="#cart-outline"></use>
                                                    </svg></a>
                                            </div>
                                        </div>
                                        <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                            <h3 class="card-title text-uppercase" style="font-size: 14px;font-weight:bold">
                                                <a href="#">{{ $f_product->name }}</a>
                                            </h3>
                                            <div class="item-price">
                                                <span class="item-price text-primary">{{ '$' . $f_product->price }}</span>
                                                <small><span class="item-price text-secondary"
                                                        style="font-size: 12px;font-weight:bold">
                                                        <del>{{ '$' . $f_product->compare_price }}</del></span></small>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination position-absolute text-center"></div>
    </section>
    {{-- Latest Products --}}
    <section id="latest-products" class="product-store padding-large position-relative">
        <div class="container">
            <div class="row">
                <div class="display-header d-flex justify-content-between pb-3">
                    <h2 class="display-7 text-dark text-uppercase">{{__('Latest Products') }}</h2>
                    <div class="btn-right">
                        <a href="{{route('shop')}}" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                    </div>
                </div>
                <div class="swiper product-watch-swiper">
                    <div class="swiper-wrapper">
                        @if (!empty($products))
                            @foreach ($products as $product)
                                <div class="swiper-slide">
                                    <div class="product-card position-relative shadow my-2 bg-body rounded p-4">
                                        <div class="image-holder">
                                            @if ($product->product_images->isNotEmpty())
                                                <img src="{{ asset('admin_assets/images/product_images/' . $product->product_images->first()->image) }}"
                                                    alt="product-item" class="img-fluid w-100" style="height:300px">
                                            @endif
                                        </div>
                                        <div class="cart-concern position-absolute">
                                            <div class="cart-button d-flex">
                                                <a href="#" class="btn btn-black">Add to Cart<svg
                                                        class="cart-outline">
                                                        <use xlink:href="#cart-outline"></use>
                                                    </svg></a>
                                            </div>
                                        </div>
                                        <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                            <h3 class="card-title text-uppercase"
                                                style="font-size: 14px;font-weight:bold">
                                                <a href="#">{{ $product->name }}</a>
                                            </h3>
                                            <div class="item-price">
                                                <span class="item-price text-primary">{{ '$' . $product->price }}</span>
                                                <small><span class="item-price text-secondary"
                                                        style="font-size: 12px;font-weight:bold">
                                                        <del>{{ '$' . $product->compare_price }}</del></span></small>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination position-absolute text-center"></div>
    </section>

    <section id="yearly-sale" class="bg-light-blue overflow-hidden mt-5 padding-xlarge"
        style="background-image: url('images/single-image1.png');background-position: right; background-repeat: no-repeat;">
        <div class="row d-flex flex-wrap align-items-center">
            <div class="col-md-6 col-sm-12">
                <div class="text-content offset-4 padding-medium">
                    <h3>10% off</h3>
                    <h2 class="display-2 pb-5 text-uppercase text-dark">New year sale</h2>
                    <a href="shop.html" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Sale</a>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">

            </div>
        </div>
    </section>
    {{-- Brands --}}
    <section id="latest-blog" class="padding-large">
        <div class="container">
            <div class="row">
                <div class="display-header d-flex justify-content-between pb-3">
                    <h2 class="display-7 text-dark text-uppercase">Brands</h2>
                    <div class="btn-right">
                        <a href="#" class="btn btn-medium btn-normal text-uppercase">Go to brands</a>
                    </div>
                </div>
                <div class="post-grid d-flex flex-wrap justify-content-between">
                    @if(!empty($brands))
                        @foreach ($brands as $brand)
                            <div class="col-lg-4 col-sm-12">
                                <div class="card border-none me-3 shadow my-2 bg-body rounded p-2">
                                     <div class="card-body text-uppercase ">
                                        <h3 class="card-title ">
                                            <a href="#">{{$brand->name}}</a>
                                        </h3>
                                    </div>
                                </div>      
                            </div>
                        @endforeach 
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section id="subscribe" class="container-grid padding-large position-relative overflow-hidden">
        <div class="container">
            <div class="row">
                <div
                    class="subscribe-content bg-dark d-flex flex-wrap justify-content-center align-items-center padding-medium">
                    <div class="col-md-6 col-sm-12">
                        <div class="display-header pe-3">
                            <h2 class="display-7 text-uppercase text-light">Subscribe Us Now</h2>
                            <p>Get latest news, updates and deals directly mailed to your inbox.</p>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <form class="subscription-form validate">
                            <div class="input-group flex-wrap">
                                <input class="form-control btn-rounded-none" type="email" name="EMAIL"
                                    placeholder="Your email address here" required="">
                                <button class="btn btn-medium btn-primary text-uppercase btn-rounded-none" type="submit"
                                    name="subscribe">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

@endsection
