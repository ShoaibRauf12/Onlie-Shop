@extends('layouts.admin.admin-app')
@section('title','Update Brand')
@section('brand','active')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Update Brand</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Home > Brand > Edit Brand</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('admin.brand')}}" class="btn btn-primary btn-sm float-end">Back</a>
                </div>

                <form action="" id="edit-brand-form">
                    <div class="card-body">
                        @csrf
                    
                        <div class="form-group mb-3">
                            <label for="name"> Brand Name </label>
                            <input type="text" name="name" id="name" class="form-control" value="{{$brand->name}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="slug"> Brand Slug </label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{$brand->slug}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="status"> Status </label>
                            <select name="status" id="status" class="form-select">
                                <option value="">Select Status</option>
                                <option value="1" {{$brand->status == 1 ? 'selected' : "" }}>Active</option>
                                <option value="0" {{$brand->status == 0 ? 'selected' : "" }}>Deactive</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm">Update</button>
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
        formSubmit('#edit-brand-form', "{{ route('admin.brand.update',$brand->id) }} ", 'POST')
        nameSlug('#name', "{{route('admin.getSlug')}}" , 'GET')

    });
</script>

@endpush