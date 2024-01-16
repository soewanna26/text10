@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('export') }}" class="btn btn-inverse-danger">Download Xlsx</a>
            </ol>
        </nav>
        <div class="row profile-body">
            <div class="col-md-8 col-xl-8 middle-wapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">
                                Import Permission
                            </h6>
                            <form action="{{ route('import') }}" method="POST" class="forms-sample" enctype="multipart/form-data"
                                id="myForm">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="import_file" class="form-label">Xlsx File Import</label>
                                    <input type="file" name="import_file" id="import_file" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-inverse-warning me-2">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    group_name: {
                        required: true,
                    }

                },
                messages: {
                    name: {
                        required: 'Please Enter Name',
                    },
                    group_name: {
                        required: 'Please Selected GroupName',
                    }


                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
