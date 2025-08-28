@extends('frontend.layout.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active">Shop</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 sidebar">
                    <!-- Categories Sidebar -->
                    <div class="mb-3">
                        <div class="card shadow-lg">
                            <div class="card-header header-dark">
                                <h2 class="h5 text-secondary">Categories</h2>
                            </div>
                            <div class="card-body">
                                <form action="#" id="searchFilters">
                                    @if ($categories->isNotEmpty())
                                        @foreach ($categories as $category)
                                            <div class="form-check mb-2" id="category_filters">
                                                <input class="form-check-input" type="checkbox" value="{{ $category->id }}"
                                                    id="category-{{ $category->id }}">
                                                <label class="form-check-label" for="category-{{ $category->id }}">
                                                    {{ $category->name }}
                                                </label>
                                            </div>
                                            @if ($category->subcategory->isNotEmpty())
                                                <div class="ms-4">
                                                    @foreach ($category->subcategory as $sub_category)
                                                        <div class="form-check mb-2" id="">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="{{ $sub_category->id }}"
                                                                id="sub-category-{{ $sub_category->id }}">
                                                            <label class="form-check-label"
                                                                for="sub-category-{{ $sub_category->id }}">
                                                                {{ $sub_category->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Brands Sidebar -->
                    <div class="mb-3">
                        <div class="card shadow-lg">
                            <div class="card-header header-dark">
                                <h2 class="h5 text-secondary">Brands</h2>
                            </div>
                            <div class="card-body">
                                @if ($brands->isNotEmpty())
                                    @foreach ($brands as $brand)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="{{ $brand->id }}"
                                                id="brand-{{ $brand->id }}">
                                            <label class="form-check-label" for="brand-{{ $brand->id }}">
                                                {{ $brand->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Price Range Sidebar -->
                    <div class="mb-3">
                        <div class="card shadow-lg">
                            <div class="card-header header-dark">
                                <h2 class="h5 text-secondary">Price Range</h2>
                            </div>
                            <div class="card-body">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="price-range" id="price-1"
                                        value="">
                                    <label class="form-check-label" for="price-1">
                                        $0 - $100
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="price-range" id="price-2"
                                        value="">
                                    <label class="form-check-label" for="price-2">
                                        $101 - $200
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="price-range" id="price-3"
                                        value="">
                                    <label class="form-check-label" for="price-3">
                                        $201 - $500
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <button class="btn border shadow-sm  d-block">Filter Products</button>
                                </div>
                                <div class="ml-2">
                                    <div class="btn-group">
                                        <select name="sort" id="sort" class="form-control">
                                            <option value="latest">Latest</option>
                                            <option value="price_asc">Price (Low to High)</option>
                                            <option value="price_desc">Price (High to Low)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Loop Start -->
                        @if ($products->isNotEmpty())
                            @foreach ($products as $product)
                                <div class="col-md-4">
                                    <div class="card product-card">
                                        <div class="product-image position-relative">
                                            <a href="" class="product-img"><img class="img-fluid w-100 card-img-top"
                                                    style="height:300px"
                                                    src="{{ asset('admin_assets/images/product_images/' . $product->product_images->first()->image) }}"
                                                    alt=""></a>
                                            <a class="whishlist" href="#"><i class="far fa-heart"></i></a>
                                            <div class="cart-concern position-absolute ms-3">
                                                <div class="cart-button d-flex">
                                                    <a href="#" class="btn btn-black">Add to Cart<svg
                                                            class="cart-outline">
                                                            <use xlink:href="#cart-outline"></use>
                                                        </svg></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body text-center mt-3">
                                            <a class="h6 link" href="">{{ $product->name }}</a>
                                            <div class="price mt-2">
                                                <span class="h5"><strong>${{ $product->price }}</strong></span>
                                                @if ($product->compare_price)
                                                    <span
                                                        class="h6 text-underline"><del>${{ $product->compare_price }}</del></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <!-- Product Loop End -->

                        <div class="col-md-12 pt-5">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('customJs')
        <script>
            $(document).ready(function() {
                $('#searchFilters').on('change', 'input[type="checkbox"]', function() {
                    let checkedCategories = [];
                    let checkedSubCategories = [];

                    $('#category_filters input[type="checkbox"]:checked').each(function() {
                        checkedCategories.push($(this).val());
                    });

                    $('.ms-4 input[type="checkbox"]:checked').each(function() {
                        checkedSubCategories.push($(this).val());
                    });
                
                    $.ajax({
                        url:"{{route('shop')}}",
                        type: 'GET',
                        data:{categories:checkedCategories,subCategories:checkedSubCategories},
                        success:function(data){
                            console.log(data);
                        }
                    });
                });

            });
        </script>
    @endpush
@endsection
