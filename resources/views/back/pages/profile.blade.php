@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    
        <div class="page-header">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="title">
									<h4>Profile</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="{{ route('admin.dashboard') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											Profile
										</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>

@livewire('admin.profile')                

@endsection
@kropifyScripts

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const cropper = new Kropify('#profilePictureFile', {
        preview: '#profilePicturePreview',
        aspectRatio: 1,
        viewMode: 1,
        processURL: '{{ route("admin.update_profile_picture") }}',
        allowedExtensions: ['jpg', 'jpeg', 'png'],
        maxSize: 2097152, // 2MB
        showLoader: true,
        animationClass: 'pulse',
        cancelButtonText: 'Cancel',
        resetButtonText: 'Reset',
        cropButtonText: 'Crop & Update',

        // Client-side / validation errors
        onError: function (msg) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: msg,
                confirmButtonColor: '#d33'
            });
        },

        // Server response
       onDone: function (response) {
    if (response.status === 1) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: response.message,
            timer: 2000,
            showConfirmButton: false
        });

        document.getElementById('profilePicturePreview').src = response.image_url;
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.message
        });
    }
}

    });

});
</script>
@endpush


