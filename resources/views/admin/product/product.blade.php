   
@extends('layouts.admin.admin-app')
@section('title','Product')
@section('product','active')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Products</h1>
    <a href="{{ route('admin.product.form') }}" class="btn btn-primary btn-sm float-end">Add New</a>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Home > Product</li>
    </ol>

    @include('admin.message')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.product')}}" class="btn btn-secondary btn-sm ">Reset</a>
                    <div class="row float-end">
                        <form method="get">
                            <div class="input-group">
                                <input type="search" value="{{Request::get('keyword')}}" class="form-control" placeholder="Search ...." name="keyword" id="keyword">
                                <button class="input-group-text btn btn-primary" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                @php
                    $count = 1;
                 @endphp
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Discount Price</th>
                                <th>SKU</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (!empty($products))
                                @foreach ( $products as $product)
                                @php
                                   $product_image = !empty($product->product_images->first()->image) ? $product->product_images->first()->image : '';
                                @endphp
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>
                                        @if($product_image == '')
                                            <img src="{{ asset('admin_assets/images/product_images/default.png') }}" alt="" width="50px" height="50px">
                                            @else
                                            <img src="{{ asset('admin_assets/images/product_images/'.  $product_image) }}" alt="" width="50px" height="50px">
                                        @endif
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td>{{number_format($product->price,2)}}</td>
                                    <td>{{number_format($product->compare_price,2)}}</td>
                                    <td>{{$product->sku}}</td>
                                    <td>{{$product->qty}}</td>
                                    <td>
                                        @if($product->status == 1)
                                        <i class="fa-regular fa-circle-check text-success"></i>
                                        @else
                                        <i class="fa-regular fa-circle-xmark text-danger"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('admin.product-edit-form',$product->id)}}" class="btn btn-info btn-sm">Edit</a>
                                        <a data-id="{{$product->id}}" class="btn btn-danger btn-sm category-btn-delete">Delete</a>
                                    </td>
                                </tr>
                                @php
                                    $count++;
                                @endphp
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="12" class="text-center">No Data Found</td>
                                </tr>
                            @endif
                           
                        </tbody>
                    </table>
                </div>
                @if (!empty($products) && $products->total() > 5)
                <div class="card-footer">
                    {{ $products->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection

@push('script')
<script>
    $(document).ready(function(e) {
        $('.category-btn-delete').click(function() {
            var id = $(this).data('id');

            var url = "{{ route('admin.category.delete', 'ID') }}";
            var newUrl = url.replace('ID',id);
            
            if (confirm("Are you sure you want to delete this record.")) {
                $.ajax({
                    url: newUrl ,
                    type: 'delete',
                    success:function(response){
                        if (response['status'] == true) {
                            window.location.href = response['redirect_url'];
                        }
                    }
                });
            }
        });

    });
</script>

@endpush