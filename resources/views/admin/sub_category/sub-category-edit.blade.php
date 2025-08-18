@extends('layouts.admin.admin-app')
@section('title','Update Sub Category')
@section('sub_category','active')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Update Sub Category</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Home > Sub Category > Edit Sub Category</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('admin.sub-category')}}" class="btn btn-primary btn-sm float-end">Back</a>
                </div>

                <form action="" id="edit-sub-category-form">
                    <div class="card-body">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="category">Category</label>
                            <select name="category" class="form-select">
                                @if(!empty($categories))
                                    <option value="">Select Category </option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id }}" {{ $category->id == $sub_category->category_id ? 'selected' : '' }}> {{$category->name }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name"> Category Name </label>
                            <input type="text" name="name" id="name" class="form-control" value="{{$sub_category->name}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="slug"> Category Slug </label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{$sub_category->slug}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="status"> Status </label>
                            <select name="status" id="status" class="form-select">
                                <option value="">Select Status</option>
                                <option value="1" {{$sub_category->status == 1 ? 'selected' : "" }}>Active</option>
                                <option value="0" {{$sub_category->status == 0 ? 'selected' : "" }}>Deactive</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="showHome"> Show Home </label>
                            <select name="showHome" id="showHome" class="form-select">
                                <option value="">Select Status</option>
                                <option value="yes" {{$sub_category->showHome == 'yes' ? 'selected' : "" }}>Yes</option>
                                <option value="no" {{$sub_category->showHome == 'no' ? 'selected' : "" }}>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm">Update</button>
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
        formSubmit('#edit-sub-category-form', "{{ route('admin.sub-category.update',$sub_category->id) }} ", 'POST')
        nameSlug('#name', "{{route('admin.getSlug')}}" , 'GET')

    });
</script>

@endpush