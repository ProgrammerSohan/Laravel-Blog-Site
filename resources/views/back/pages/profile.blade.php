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
            processURL: '',
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            maxSize: 2097152, // 2MB
            showLoader: true,
            animationClass: 'pulse',
            cancelButtonText: 'Cancel',
            resetButtonText: 'Reset',
            cropButtonText: 'Crop & Update',

            onError: function (msg) {
                alert(msg);
            },

            onDone: function (response) {
                console.log(response);

                if (response.status === 'success') {
                    // update image preview after crop
                    document.getElementById('profilePicturePreview').src = response.image_url;
                }
            }
        });

    });
</script>
@endpush

