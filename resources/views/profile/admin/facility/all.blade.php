@extends('profile.admin.profile')

@section('content-section')
<div class="card">
    <div class="card-header">
        <h2 class="list-title">Facility List</h2>

        <div class="card-tools d-flex">

            <div class="topnav">
                {{-- <a href="{{ route('admin.location.create') }}" id="home">Add Facility +</a> --}}
                <div class="search-container">
                    <form action="" method="GET" id="navForm">
                        <button class="btn" type="submit"><i class="fa fa-search">Go</i></button>
                        <input type="text" placeholder="Search.." name="search" value="{{ request('search') }}">      
                        <select class="selectForm form-select m-2 w-25" aria-label=".form-select-lg example"
                            name="order">
                            <option value="">OrderBy...</option>
                            <option value="alphabet" @if (request('order') == 'alphabet') selected @endif>Alphabet</option>
                        </select>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="card-body table-responsive p-0 mt-3 cardColor">
        <form action="{{ route('admin.facilities.store') }}" class="p-2" method="POST"  >
            @csrf

            <div class="form-row d-flex justify-content-around ">
                <div class="form-group col-md-3">
                    <label class="label">Create Facility</label>
                    <input name="name" type="text"
                    class="form-control mt-2 @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <button type="submit" class="btn btn-outline-primary d-flex align-self-end">Create</button>
            </div>

        </form>

        <table class="table table-bordered table-dark" id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Facility</th>
                    <th scope="col">Operation</th>
                    {{-- <th scope="col">Operation</th> --}}
                </tr>
            </thead>
            <tbody class="">
                @foreach ($facilities as $key => $facility)
                    <tr>
                        <th scope="row">{{ $facility->id }}</th>
                        <td>{{ $facility->name }}</td>
                    
                        <td class="d-flex justify-content-around ">
                            <form action="{{ route('admin.facilities.destroy', ['facility' => $facility->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button class= "deleteRecord btn btn-outline-danger btn-block">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    <span><strong>Delete</strong></span>
                                </button>
                            </form>

                            <a href="{{ route('admin.facilities.edit', ['facility' => $facility->id]) }}"
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
            {{-- {{ $facilitys->appends('search' => request(['']))->render() }} --}}
            {{ $facilities->appends(['search' => Request::get('search')])->links() }}
            {{-- {{ $facilitys->links() }} --}}
        </div>
    </div>
</div>
@endsection