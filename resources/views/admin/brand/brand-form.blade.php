@extends('layouts.admin.admin-app')
@section('title','Create Brand')
@section('brand','active')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Create Brand</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Home > Brand > Create Brand</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('admin.brand')}}" class="btn btn-primary btn-sm float-end">Back</a>
                </div>
                <form action="" method="post" id="create-brand-form" enctype="multipart/form-data">
                    <div class="card-body">
                        
                        <div class="form-group mb-3">
                            <label for="name"> Brand Name </label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="slug"> Brand Slug </label>
                            <input type="text" name="slug" id="slug" class="form-control" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status"> Status </label>
                            <select name="status" id="status" class="form-select">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm">Create</button>
                            <a href="{{ route('admin.brand') }}" class="btn btn-secondary btn-sm">Cancel</a>
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
        formSubmit('#create-brand-form', "{{ route('admin.brand.add') }} " , 'POST')
        nameSlug('#name', "{{route('admin.getSlug')}}" , 'GET')

    });
</script>
@endpush