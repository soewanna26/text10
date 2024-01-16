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
                                Update Permission
                            </h6>
                            <form action="{{ route('update.permission') }}" method="POST" class="forms-sample">
                                @csrf
                                <input type="hidden" name="id" value="{{ $permission->id }}">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Pemission Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $permission->name }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="group_name" class="form-label">Group Name</label>
                                    <select name="group_name" id="group_name" class="form-control">
                                        <option selected="" disabled>Select Group</option>
                                        <option value="type" {{ $permission->group_name == 'type' ? 'selected' : '' }}>
                                            Property Type</option>
                                        <option value="state" {{ $permission->group_name == 'state' ? 'selected' : '' }}>
                                            Property State</option>
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
