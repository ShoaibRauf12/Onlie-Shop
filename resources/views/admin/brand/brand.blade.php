@extends('layouts.admin.admin-app')
@section('title', 'Brands')
@section('brand', 'active')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Brands</h1>
    <a href="{{ route('admin.brand.form') }}" class="btn btn-primary btn-sm float-end">Add New</a>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Home > Brand</li>
    </ol>

    @include('admin.message')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.brand')}}" class="btn btn-secondary btn-sm ">Reset</a>
                    <div class="row float-end">
                        <form method="get">
                            <div class="input-group">
                                <input type="search" value="{{Request::get('keyword')}}" class="form-control" placeholder="Search ...." name="keyword" id="keyword">
                                <button class="input-group-text btn btn-primary" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($brands))
                            @foreach ( $brands as $brand)
                            <tr>
                                <td>{{$brand->id}}</td>
                                <td>{{$brand->name}}</td>
                                <td>{{$brand->slug}}</td>
                                <td>
                                    @if($brand->status == 1)
                                    <i class="fa-regular fa-circle-check text-success"></i>
                                    @else
                                    <i class="fa-regular fa-circle-xmark text-danger"></i>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.brand-edit-form',$brand->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <a data-id="{{$brand->id}}" class="btn btn-danger btn-sm brand-btn-delete">Delete</a>
                                </td>
                            </tr>

                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                @if (!empty($brands) && $brands->total() > 5)
                <div class="card-footer">
                    {{ $brands->links() }}
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
        $('.brand-btn-delete').click(function() {
            var id = $(this).data('id');

            var url = "{{ route('admin.brand.delete', 'ID') }}";
            var newUrl = url.replace('ID', id);

            if (confirm("Are you sure you want to delete this record.")) {
                $.ajax({
                    url: newUrl,
                    type: 'delete',
                    success: function(response) {
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