@extends('layouts.admin.admin-app')
@section('title','Sub Category')
@section('sub_category','active')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Create Sub Category</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Home > Sub Category > Create Sub Category</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('admin.sub-category')}}" class="btn btn-primary btn-sm float-end">Back</a>
                </div>
                <form action="" method="post" id="create-sub-category-form" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="category">Category</label>
                            <select name="category" class="form-select">
                                @if(!empty($categories))
                                    <option value="">Select Category </option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id }}">{{$category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="name">Sub Category Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="slug">Sub Category Slug </label>
                            <input type="text" name="slug" id="slug" class="form-control" readonly />
                        </div>
                        <div class="form-group mb-3">
                            <label for="status"> Status </label>
                            <select name="status" id="status" class="form-select">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="showHome"> Show Home </label>
                            <select name="showHome" id="showHome" class="form-select">
                                <option value="">Select Status</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm">Create</button>
                            <a href="{{ route('admin.sub-category') }}" class="btn btn-secondary btn-sm">Cancel</a>
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
        formSubmit('#create-sub-category-form', "{{ route('admin.sub-category.add') }} ", 'POST')
        nameSlug('#name', "{{route('admin.getSlug')}}", 'GET')

    });
</script>
@endpush