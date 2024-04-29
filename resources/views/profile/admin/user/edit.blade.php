@extends('profile.admin.profile')

@section('content-section')
    <div class="card">
        <div class="card-header">
            <h2 class="list-title">Edit User</h2>

            {{-- <div class="card-tools d-flex">

                <div class="topnav">
                    <a  href="{{route('admin.users.create')}}" id="home">Add User+</a>
                    <div class="search-container">
                        <form action="/action_page.php">
                            <input type="text" placeholder="Search.." name="search">
                            <button class="btn" type="submit"><i class="fa fa-search">Go</i></button>
                        </form>
                    </div>
                </div>

            </div> --}}
        </div>

        <!-- /.card-header -->
        <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="POST" class="m-2 form">
            @csrf
            @method('PUT')
            <div class="border d-flex flex-column">
                <div class="p-3">
                    <div class="row">
                        <div class="w-50">
                            <label class="label">
                                First Name
                            </label>
                            <input name="firstName" type="text"
                                class="form-control @error('firstName') is-invalid @enderror"
                                value="{{ old('firstName', $user->firstName) }}" />
                            @error('firstName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-50">
                            <label class="label">
                                Last Name
                            </label>
                            <input name="lastName" type="text"
                                class="form-control @error('lastName') is-invalid @enderror"
                                value="{{ old('lastName', $user->lastName) }}" />
                            @error('lastName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class=" w-50">
                            <label class="">
                                Email
                            </label>
                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-50">
                            <label class="">
                                Phone
                            </label>
                            <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $user->phone) }}" />
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class=" w-50">
                            <label class="label">
                                Password
                            </label>
                            <input name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" value="{{old('password' , $user->password)}}"/>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-50">
                            <label class="label">
                                Confirm Password
                            </label>
                            <input name="password_confirmation" type="password" class="form-control" value="{{old('password' , $user->password)}}" />
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class=" w-50">
                            <label class="label">
                                Role
                            </label>
                            <select class="form-select" name="role">
                                <option value="{{ old('role', $user->role) }}">{{ old('role', $user->role) }}</option>
                                <option value="admin">Admin</option>
                                <option value="consultant">Consultant</option>
                                <option value="user">User</option>
                            </select>
                        </div>

                    </div>
                    @if (!$user->hasVerifiedEmail())
                        <div class="row mt-3 form-check ">
                            <div class="w-50">
                                <input type="checkbox" name="verify" class="form-check-input" id="verify">
                                <label class="label">
                                    Accounts Verified
                                </label>
                            </div>
                        </div>
                    @endif


                    <button style="width:40%;" type="submit" class="btn btn-outline-success btn-block mt-5 mx-50">
                        <i class="fa fa-paper-plane">Edit</i>
                    </button>
                </div>
            </div>
        </form>
        <!-- /.card-body -->

    </div>
@endsection
