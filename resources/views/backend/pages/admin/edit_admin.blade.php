@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="row profile-body">
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">

                                <h6 class="card-title">Add Admin</h6>

                                <form class="forms-sample" method="POST" action={{ route('update.admin',$user->id) }}>
                                    @csrf

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Admin UserName</label>
                                        <input type="text" name="username" value="{{ $user->username }}"
                                            class="form-control
                                        @error('username')
                                            is-invalid
                                        @enderror">
                                        @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Admin Name</label>
                                        <input type="text" name="name" value="{{ $user->name }}"
                                            class="form-control
                                        @error('name')
                                            is-invalid
                                        @enderror">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Admin Email</label>
                                        <input type="email" name="email" value="{{ $user->email }}"
                                            class="form-control
                                        @error('email')
                                            is-invalid
                                        @enderror">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Admin Phone</label>
                                        <input type="text" name="phone" value="{{ $user->phone }}"
                                            class="form-control
                                        @error('phone')
                                            is-invalid
                                        @enderror">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Admin Address</label>
                                        <input type="text" name="address" value="{{ $user->address }}"
                                            class="form-control @error('address') is-invalid @enderror">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="role-id" class="form-label">Roles Name</label>
                                        <select name="roles" class="form-select">
                                            <option selected="" disabled>Select Group</option>
                                            @foreach ($roles as $role)
                                                <option
                                                    value="{{ $role->name }}"{{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary me-2">Save Change</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
