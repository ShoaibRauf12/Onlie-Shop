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

                <form action="" id="edit-category-form">
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
                        <div class="form-group mb-3">
                            <label for="showHome"> Show Home </label>
                            <select name="showHome" id="showHome" class="form-select">
                                <option value="">Select showHome</option>
                                <option value="yes" {{$category->showHome == 'yes' ? 'selected' : "" }}>Yes</option>
                                <option value="no" {{$category->showHome == 'no' ? 'selected' : "" }}>No</option>
                            </select>
                        </div>
                        <!-- Image Upload via Dropzone -->
                        <div class="fom-group mb-3">
                            <label for="image" class="image">Image</label>
                            <input type="hidden" name="image_id" id="image_id">
                            <div id="image" class="dropzone dz-clickable">
                                <div class="dz-message needsclick">    
                                    <br>Drop files here or click to upload.<br><br>                                            
                                </div>
                            </div>
                            <div class=" mt-1">
                                <img class="img-fluid img-thumbnail" style="width:100px;height:100px;" src="{{ asset('admin_assets/images/category_images/thumb/'.$category->image) }}" alt="">
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
    $(document).ready(function(e){
     formSubmit('#edit-category-form', "{{route('admin.category.edit',$category->id) }}", 'POST',);

        $('#name').on('change', function() {
            var slug = $(this);
            $.ajax({
                url: '{{ route("admin.getSlug") }}',
                type: 'get',
                data: {
                    title: slug.val()
                },
                dataType: 'json',
                success: function(response) {

                    if (response.success == true) {
                        $('#slug').val(response.slug);
                    }
                }
            });
        });

        Dropzone.autoDiscover = false;    
        const dropzone = $("#image").dropzone({ 
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            url:  "{{ route('admin.category.image.upload') }}",
            maxFiles: 1,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                $("#image_id").val(response.image_id);
                //console.log(response)
            }
        });
    });
</script>
    
@endpush