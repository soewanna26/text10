@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="row profile-body">
            <div class="col-md-8 col-xl-8 middle-wapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">
                                Add Role
                            </h6>
                            <form action="{{ route('store.roles') }}" method="POST" class="forms-sample" id="myForm">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Role Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
