@extends('profile.admin.profile')

@section('content-section')
    <div class="card">
        <div class="card-header">
            <h2 class="list-title">Users List</h2>

            <div class="card-tools d-flex">

                <div class="topnav">
                    <a href="{{ route('admin.users.create') }}" id="home">Add User+</a>
                    <div class="search-container">
                        <form action="" method="GET" id="navForm">
                            <button class="btn" type="submit"><i class="fa fa-search">Go</i></button>
                            <input type="text" placeholder="Search.." name="search" value="{{ request('search') }}" id="searchInput">
                            <select class="selectForm form-select m-2 w-25" aria-label=".form-select-lg example" name="order" id="orderSelect">
                                <option value="">OrderBy...</option>
                                <option value="recent" @if (request('order') == 'recent') selected @endif>Recent</option>
                                <option value="role" @if (request('order') == 'role') selected @endif>Role</option>
                                <option value="alphabet" @if (request('order') == 'alphabet') selected @endif>Alphabet</option>
                              </select>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive p-0 mt-3">
            <table class="table table-bordered table-dark " id="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Register Date</th>
                        <th scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->firstName }}</td>
                            <td>{{ $user->lastName }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="{{ $user->isAdmin() ? 'admin' : ($user->isConsultant() ? 'consultant' : '') }}">
                                {{ $user->role }}
                            </td>
                            <td>{{ $user->created_at }}</td>
                            <td class="d-flex justify-content-around">
                                <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class= "deleteRecord btn btn-outline-danger btn-block">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        <span><strong>Delete</strong></span>
                                    </button>
                                    {{-- <a href="{{ route('admin.users.destroy', ['user' => $user->id]) }}" class="btn delete a-btn-slide-text">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                         <span><strong>Delete</strong></span>            
                                     </a> --}}
                                </form>

                                {{-- <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                                    class="btn btn-danger m-1">Edit</a> --}}
                                <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                                    class="btn btn-outline-success btn-block">
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    <span><strong>Edit</strong></span>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="card-footer">
                {{-- {{ $users->appends('search' => request(['']))->render() }} --}}
                {{ $users->appends(['search' => Request::get('search')])->links() }}
                {{-- {{ $users->links() }} --}}
            </div>
        </div>
        <!-- /.card-body -->

    </div>
@endsection
