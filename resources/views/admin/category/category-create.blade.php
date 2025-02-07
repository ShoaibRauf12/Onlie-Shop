@extends('layouts.admin.admin-app')
@section('title','Category')
@section('category','active')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Create Category</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Home > Category > Create Category</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('admin.category')}}" class="btn btn-primary btn-sm float-end">Back</a>
                </div>
                <form action="" method="post" id="create-category-form" enctype="multipart/form-data">
                    <div class="card-body">
                        
                        <div class="form-group mb-3">
                            <label for="name"> Category Name </label>
                            <input type="text" name="name" id="name" class="form-control">
                            <p></p>

                        </div>
                        <div class="form-group mb-3">
                            <label for="slug"> Category Slug </label>
                            <input type="text" name="slug" id="slug" class="form-control" readonly>
                            <p></p>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status"> Status </label>
                            <select name="status" id="status" class="form-select">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                            <p></p>

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
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm">Create</button>
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
        $('#create-category-form').submit(function(e) {
            e.preventDefault();
            var element = $(this);


            var formData = element.serialize();
            $.ajax({
                url: '{{ route("admin.category.add") }}',
                type: 'post',
                data: formData,
                dataType: 'json',
                success: function(response) {

                    if (response['status'] == true) {
                        window.location.href = response['redirect_url']
                    } else {
                        var error = response.errors;

                        // Name Error Handling
                        if (error['name'] && error['name'][0]) {
                            $('#name').addClass('is-invalid');
                            $('#name').siblings('p').addClass('text-danger').text(error['name'][0]);
                        } else {
                            $('#name').removeClass('is-invalid');
                            $('#name').siblings('p').removeClass('text-danger').text('');
                        }

                        // Slug Error Handling
                        if (error['slug'] && error['slug'][0]) {
                            $('#slug').addClass('is-invalid');
                            $('#slug').siblings('p').addClass('text-danger').text(error['slug'][0]);
                        } else {
                            $('#slug').removeClass('is-invalid');
                            $('#slug').siblings('p').removeClass('text-danger').text('');
                        }

                        // Status Error Handling
                        if (error['status'] && error['status'][0]) {
                            $('#status').addClass('is-invalid');
                            $('#status').siblings('p').addClass('text-danger').text(error['status'][0]);
                        } else {
                            $('#status').removeClass('is-invalid');
                            $('#status').siblings('p').removeClass('text-danger').text('');
                        }




                    }
                }
            });
        });

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