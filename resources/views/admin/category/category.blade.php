@extends('layouts.admin.admin-app')
@section('title','Dashboard')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Category</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Home > Category</li>
    </ol>

        @include('admin.message')

    <div class="row">
        <div class="col-md-12">
        
            <button class="btn btn-primary btn-sm float-end my-2" data-bs-toggle="modal" data-bs-target="#createCategoryModal">Add New</button>
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
                    @if (!empty($categories))
                        @foreach ( $categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->slug}}</td>
                                <td>
                                    @if($category->status == 1)
                                        {{'Active'}}
                                        @else
                                        {{'Deactive'}}
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm"  data-bs-toggle="modal" data-bs-target="#updateCategoryModal_{{$category->id}}">Edit</button>
                                    <a href="{{route('admin.category.delete',$category->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            {{-- Edit Category_model --}}
                            <div class="modal fade" id="updateCategoryModal_{{$category->id}}" tabindex="-1" aria-labelledby="updateCategoryModalLabel_{{$category->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="updateCategoryModalLabel_{{$category->id}}">Update Category</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.category.edit',$category->id) }}" method="post">
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
                                                        <option value="1" {{$category->status == 1 ? 'selected' : "" }} >Active</option>
                                                        <option value="0" {{$category->status == 0 ? 'selected' : "" }}>Deactive</option>
                                                    </select>

                                                    @error('status')
                                                    <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-3">
                                                    <button class="btn btn-primary btn-sm">Update</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        @endforeach
                    @endif
                </tbody>
            </table>
            @if (!empty($categories))
            {{ $categories->links() }}
            @endif
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createCategoryModalLabel">Create Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.category.add') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name"> Category Name </label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="slug"> Category Slug </label>
                        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror">
                        @error('slug')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="status"> Status </label>
                        <select name="status" id="status" class="form-select @error('slug') is-invalid @enderror">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>

                        @error('status')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-primary btn-sm">Create</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


    @endsection