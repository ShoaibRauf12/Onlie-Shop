@extends('layouts.admin.admin-app')
@section('title','Update Category')
@section('category','active')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Update Category</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Home > Category > Edit Category</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('admin.category')}}" class="btn btn-primary btn-sm float-end">Back</a>
                </div>

                <form action="{{ route('admin.category.edit',$category->id) }}" method="post">
                    <div class="card-body">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name"> Category Name </label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{$category->name}}">
                            @error('name')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="slug"> Category Slug </label>
                            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{$category->slug}}">
                            @error('slug')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="status"> Status </label>
                            <select name="status" id="status" class="form-select">
                                <option value="">Select Status</option>
                                <option value="1" {{$category->status == 1 ? 'selected' : "" }}>Active</option>
                                <option value="0" {{$category->status == 0 ? 'selected' : "" }}>Deactive</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
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