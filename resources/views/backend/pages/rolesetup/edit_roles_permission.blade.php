@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style type="text/css">
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
    <div class="page-content">
        <div class="row profile-body">
            <div class="col-md-12 col-xl-12 middle-wapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">
                                Edit Roles Permission
                            </h6>
                            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" class="forms-sample"
                                id="myForm">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="role-id" class="form-label">Roles Name</label>
                                    <h3>{{ $role->name }}</h3>
                                </div>

                                <div class="form-check mb-2">
                                    <input type="checkbox" id="checkDefaultmain" class="form-check-input">
                                    <label for="checkDefaultmain" class="form-check-label">Permission All</label>
                                </div>

                                <hr>

                                @foreach ($permission_groups as $groups)
                                    <div class="row">
                                        <div class="col-3">

                                            @php
                                                $permissions = App\Models\User::getpermissionByGroupName($groups->group_name);
                                            @endphp
                                            <div class="form-check mb-2">
                                                <input type="checkbox" name="checkDefault" id="checkDefault"
                                                    {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}
                                                    class="form-check-input">
                                                <label for="checkDefault"
                                                    class="form-check-label">{{ $groups->group_name }}</label>
                                            </div>
                                        </div>
                                        <div class="col-9">

                                            @foreach ($permissions as $permission)
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" name="permission[]"
                                                        id="checkDefault{{ $permission->id }}" class="form-check-input"
                                                        value="{{ $permission->name }}"
                                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                    <label for="checkDefault{{ $permission->id }}"
                                                        class="form-check-label">{{ $permission->name }}</label>
                                                </div>
                                            @endforeach
                                            <br>
                                        </div>


                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-primary me-2">Update Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script text="type/javascript">
        $('#checkDefaultmain').click(function() {
            if ($(this).is(":checked")) {
                $('input[type=checkbox]').prop('checked', true);
            } else {
                $('input[type=checkbox]').prop('checked', false);
            }
        })
    </script>
@endsection
