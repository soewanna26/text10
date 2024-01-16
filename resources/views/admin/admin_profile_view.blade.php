@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .equal-size-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
        }
        .size-image{
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
    <div class="page-content">
        <div class="row profile-body">
            <!-- left wrapper start -->
            <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>
                                <img class="wd-100 rounded-circle size-image"
                                    src="{{ !empty($profileData->photo) ? url('upload/admin_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                    alt="profile">
                                <span class="h4 ms-3">{{ $profileData->username }}</span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                            <p class="text-muted">{{ $profileData->name }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                            <p class="text-muted">{{ $profileData->email }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                            <p class="text-muted">{{ $profileData->phone }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                            <p class="text-muted">{{ $profileData->address }}</p>
                        </div>
                        <div class="mt-3 d-flex social-links">
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="github"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="twitter"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">

                                <h6 class="card-title">Basic Form</h6>

                                <form class="forms-sample" method="POST" action={{ route('admin.profile.store') }}
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            value={{ $profileData->username }} autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value={{ $profileData->email }}>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="phone" class="form-control" id="phone" name="phone"
                                            value={{ $profileData->phone }} autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="address" class="form-control" id="address" name="address"
                                            value={{ $profileData->address }} autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="formFile">File upload</label>
                                        <input class="form-control" type="file" id="image" name="photo"
                                            value={{ $profileData->photo }}>
                                    </div>
                                    <div class="mb-3">
                                        <img class="wd-80 rounded-circle equal-size-image" id="showImage"
                                            src="{{ !empty($profileData->photo) ? asset('upload/admin_images/'.$profileData->photo) : asset('upload/no_image.jpg') }}"
                                            alt="profile">
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Save Change</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->
            <!-- right wrapper end -->
        </div>

    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        })
    </script>
@endsection
