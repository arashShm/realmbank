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
        <form action="{{ route('admin.facilities.update', ['facility' => $facility->id]) }}" method="POST" class="m-2 form">
            @csrf
            @method('PUT')
            <div class="border d-flex flex-column">
                <div class="p-3">
                    <div class="row">
                        <div class="w-50">
                            <label class="label">
                                Facility Name
                            </label>
                            <input name="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $facility->name) }}" />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
  
                    <button style="width:40%;" type="submit" class="btn btn-outline-success btn-block mt-5 mx-50">
                        <i class="fa fa-paper-plane">Edit</i>
                    </button>
                </div>
            </div>
        </form>
        <!-- /.card-body -->

    </div>
@endsection
