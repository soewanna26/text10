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
                                Add Permission
                            </h6>
                            <form action="{{ route('store.permission') }}" method="POST" class="forms-sample" id="myform">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Pemission Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="group_name" class="form-label">Group Name</label>
                                    <select name="group_name" id="group_name" class="form-control">
                                        <option selected="" disabled>Select Group</option>
                                        <option value="type">Property Type</option>
                                        <option value="state">Property State</option>
                                        <option value="email">Email</option>
                                        <option value="ui">UI Kit</option>
                                        <option value="advanced">Advanced UI</option>
                                        <option value="role">Role & Permission</option>
                                    </select>
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
