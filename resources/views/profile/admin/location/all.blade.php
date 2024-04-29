@extends('profile.admin.profile')

@section('content-section')
    <div class="card">
        <div class="card-header">
            <h2 class="list-title">City & Country List</h2>

            <div class="card-tools d-flex">

                <div class="topnav">
                    <a href="{{ route('admin.location.create') }}" id="home">Add Country +</a>
                    <div class="search-container">
                        <form action="" method="GET" id="navForm">
                            <button class="btn" type="submit"><i class="fa fa-search">Go</i></button>
                            <input type="text" placeholder="Search.." name="search" value="{{ request('search') }}"
                                id="searchInput">
                            <select class="selectForm form-select m-2 w-25" aria-label=".form-select-lg example"
                                name="order" id="orderSelect">
                                <option value="">OrderBy...</option>
                                <option value="alphabet" @if (request('order') == 'alphabet') selected @endif>Alphabet</option>
                            </select>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="card-body table-responsive p-0 mt-3 cardColor">
            <form action="{{ route('admin.cities.store') }}" class="p-2" method="POST" id="form">
                @csrf

                <div class="form-row d-flex justify-content-around ">
                    <div class="form-group col-md-3">
                        <label class="label">Choose Country</label>
                        <select class="form-control @error('country_id') is-invalid @enderror mt-2" name="country_id">
                            <option value="">Choose...</option>
                            @foreach (App\Models\Country::all() as $country)
                                <option value="{{ $country->id }}">{{ $country->countryName }}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="label">City Name</label>
                        <input name="cityName" type="text"
                            class="form-control mt-2 @error('cityName') is-invalid @enderror"
                            value="{{ old('cityName') }}" />
                        @error('cityName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-primary d-flex align-self-end">Create City</button>
                </div>

            </form>

            <table class="table table-bordered table-dark" id="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Country Name</th>
                        <th scope="col">City Name</th>
                        {{-- <th scope="col">Operation</th> --}}
                    </tr>
                </thead>
                <tbody class="">
                    @foreach ($countries as $key => $country)
                        <tr>
                            <th scope="row">{{ $country->id }}</th>
                            <td>{{ $country->countryName }}</td>
                            <td> 
                                @foreach ($country->cities as $city)
                                    <ul>
                                        <li>{{ $city->cityName }}</li>
                                    </ul>
                                @endforeach
                            </td>
                            {{-- <td class="d-flex justify-content-around ">
                                <form action="{{ route('admin.countries.destroy', ['country' => $city->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class= "deleteRecord btn btn-outline-danger btn-block">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        <span><strong>Delete</strong></span>
                                    </button>
                                </form>

                                <a href="{{ route('admin.countries.edit', ['country' => $city->id]) }}"
                                    class="btn btn-outline-success btn-block">
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    <span><strong>Edit</strong></span>
                                </a>

                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer">
                {{-- {{ $countrys->appends('search' => request(['']))->render() }} --}}
                {{ $countries->appends(['search' => Request::get('search')])->links() }}
                {{-- {{ $countrys->links() }} --}}
            </div>
        </div>
    </div>
@endsection
