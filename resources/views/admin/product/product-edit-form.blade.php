@extends('layouts.admin.admin-app')
@section('title','Update Product')
@section('product','active')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Update Product</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Home > Product > Update Product</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('admin.product')}}" class="btn btn-primary btn-sm float-end">Back</a>
                </div>
                <form action="" method="post" id="update-product-form" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="shadow-sm p-3 mb-3 product-information bg-body rounded">
                                            
                                            <div class="form-group mb-3">
                                                <label for="name"> Title </label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="slug"> Product Slug </label>
                                                <input type="text" name="slug" id="slug" class="form-control" readonly value="{{ $product->slug }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="description"> Description </label>
                                                <textarea name="description" id="description" class="form-control" rows="5" >{{$product->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="shadow-sm p-3 mb-3 product-media bg-body rounded">
                                            <!-- Image Upload via Dropzone -->
                                            <div class="fom-group mb-3 upload_media">
                                                <label for="media" class="media">Media</label>
                                                <input type="file" name="media[]" id="media" class="form-control" multiple>
                                            </div>
                                            <div class="row" id="existing-images">
                                                @if (!empty($product->product_images))
                                                    @foreach ($product->product_images as $image)
                                                        <div class="col-md-3 image-box" data-id="{{ $image->id }}">
                                                            <div class="card mb-3">
                                                                <img src="{{ asset('admin_assets/images/product_images/'. $image->image) }}" alt="" class="img-fluid" style="height:120px;width: 120;">
                                                                <button type="button" class="btn btn-danger btn-sm btn-block mt-2 remove-image" data-id="{{ $image->id }}">Delete</button>
                                                            </div>
                                                            <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="shadow-sm p-3 mb-3 product-price bg-body rounded">
                                            <h6>Pricing</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="price"> Price </label>
                                                        <input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="compare_price"> Compare at Price </label>
                                                        <input type="text" name="compare_price" id="compare_price" class="form-control" value="{{ $product->compare_price }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   <div class="col-md-12">
                                        <div class="shadow-sm p-3 mb-3 product-inventory bg-body rounded">
                                            <h6>Inventory</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="sku"> SKU </label>
                                                        <input type="text" name="sku" id="sku" class="form-control" value="{{ $product->sku }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="barcode"> Barcode </label>
                                                        <input type="text" name="barcode" id="barcode" class="form-control" value="{{ $product->barcode }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <input type="checkbox" name="track_qty" id="" {{ $product->track_qty == 'yes' ? 'checked' : '' }} >
                                                        <label for="quantity"> Track Quantity </label>
                                                        <input type="number" name="track_quantity" id="track_quantity" class="form-control" value="{{ $product->qty }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                </div>
                            </div>
                            <!-- sidebar -->
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Product status</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="status">Select Status</label>
                                                    <select name="status" id="status" class="form-select">
                                                        <option value="">Select Status</option>
                                                        <option value="1"  {{ $product->status == 1 ? 'selected' : '' }} >Active</option>
                                                        <option value="0"{{ $product->status == 0 ? 'selected' : '' }} >Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Product Category</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="category">Select Category</label>
                                                    <select name="category" id="category" class="form-select">
                                                        <option value="">Select Category</option>
                                                        @if (!empty($categories))
                                                        @foreach ($categories as $category)
                                                        <option value="{{$category->id}}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group my-3">
                                                    <label for="sub_category fw-bold">Select Sub Category</label>
                                                    <select name="sub_category" id="sub_category" class="form-select">   
                                                        <option value="">Select Sub Category</option>
                                                        @if (!empty($sub_categories))
                                                                @foreach ($sub_categories as $sub_category)
                                                                <option value="{{$sub_category->id}}" {{ $product->subcategory_id == $sub_category->id ? 'selected' : '' }}>{{$sub_category->name}}</option>
                                                                @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Product Brand</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="brand">Select Brand</label>
                                                    <select name="brand" id="brand" class="form-select">
                                                        <option value="">Select Brand</option>
                                                        @if (!empty($brands))
                                                        @foreach ($brands as $brand)
                                                        <option value="{{$brand->id}}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{$brand->name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Featured Product</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <select name="is_featured" id="is_featured" class="form-select">
                                                        <option value="">Select</option>
                                                        <option value="1" {{ $product->is_featured == 'yes' ? 'selected' : ''}}>Yes</option>
                                                        <option value="0" {{ $product->is_featured == 'no' ? 'selected' : ''}}>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm">Update</button>
                            <a href="{{ route('admin.category') }}" class="btn btn-secondary btn-sm">Cancel</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>


    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        formSubmit('#update-product-form', "{{ route('admin.product.update', $product->id) }} ", 'POST')
        nameSlug('#name', "{{route('admin.getSlug')}}", 'GET')

        // image upload
        $('#media').change(function() {
            var file = $(this).get(0).files;
            if (file.length > 0) {
                var formData = new FormData();
                for (var i = 0; i < file.length; i++) {
                    formData.append('media[]', file[i]);
                }
                $.ajax({
                    url: "{{ route('admin.product.image.upload') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response['success'] == true) {
                           var mediaIds = response['media_id'];
                            mediaIds.forEach(function(id) {
                                var mediaInput = '<input type="hidden" name="media_id[]" value="' + id + '">';
                                $('.upload_media').append(mediaInput);
                            });
                            
                        }
                    }
                });
            }
        });

        // category
        $('#category').on('change',function(){
            var category_id = $(this).val();
        
            $.ajax({
                url: "{{ route('admin.product.subcategory') }}",
                data: {
                    category_id: category_id
                },
                type: 'post',
                success: function(response) {
                if (response['status'] == true) {
                        var sub_categories = response['sub_categories'];
                        $('#sub_category').empty();
                        $('#sub_category').append('<option value="">Select Sub Category</option>');
                        $.each(sub_categories, function(key, value) {
                            $('#sub_category').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                }
            }); 
        });

    });

    $(document).on('click', '.remove-image', function() {
    var id = $(this).data('id');
    // Image box ko frontend se hata do
    $('.image-box[data-id="' + id + '"]').remove();
});
    
</script>
@endpush