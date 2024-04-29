@extends('profile.admin.profile')

@section('content-section')
    <div class="card">
        <div class="card-header">
            <h2 class="list-title">Create User</h2>

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
        <form action="{{ route('admin.properties.store') }}" method="POST" class="m-2 form" enctype="multipart/form-data"
            id="propertyForm">
            @csrf

            <div class="border d-flex flex-column">
                <div class="p-3">
                    <div class="row">
                        <div class="w-50">
                            <label class="label">
                                image
                            </label>
                            <input name="image" type="file" class="form-control @error('image') is-invalid @enderror"
                                value="{{ old('image') }}" />
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-50">
                            <label class="label">
                                Area
                            </label>
                            <input name="area" type="text" class="form-control @error('area') is-invalid @enderror"
                                value="{{ old('area') }}" />
                            @error('area')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class=" w-50">
                            <label class="label">
                                Plot
                            </label>
                            <select name="plot" id="" class="form-control @error('plot') is-invalid @enderror">
                                <option value="">Choose Plot...</option>
                                <option value="residential" {{ "residential" === old('plot') ? 'selected' : '' }}>Residential</option>
                                <option value="commercial" {{ "commercial" === old('plot') ? 'selected' : '' }}>Commercial</option>
                                <option value="farm" {{ "farm" === old('plot') ? 'selected' : '' }}>Farm</option>
                                <option value="villa"{{ "villa" === old('plot') ? 'selected' : '' }}>Villa</option>
                                <option value="flat" {{ "flat" === old('plot') ? 'selected' : '' }}>Flat</option>
                            </select>
                            @error('plot')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-50">
                            <label class="label">
                                User
                            </label>
                            <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                <option value="">Choose User...</option>
                                @foreach (\App\Models\User::all() as $user)
                                    <option value="{{ $user->id }}" {{ (collect(old('user_id'))->contains($user->id)) ? 'selected':'' }}>{{ $user->firstName . ' ' . $user->lastName }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class=" w-50">
                            <label class="label">
                                Rooms
                            </label>
                            <input name="rooms" type="number" class="form-control @error('rooms') is-invalid @enderror"
                                value="{{ old('rooms') }}" />
                            @error('rooms')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-50">
                            <label class="label">
                                Price
                            </label>
                            <input name="price" type="number" class="form-control @error('price') is-invalid @enderror"
                                value="{{ old('price') }}" />
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class=" w-25">
                            <label class="label">
                                Country
                            </label>

                            <select class="form-select @error('country_id') is-invalid @enderror" name="country_id"
                                id="countrySelect">
                                <option value="">Choose Country...</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->countryName }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class=" w-25">
                            <label class="label">
                                City
                            </label>
                            <select class="form-select @error('city_id') is-invalid @enderror" name="city_id"
                                id="citySelect">
                                <option value="">Choose City...</option>
                            </select>
                            @error('city_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-50">
                            <label class="label">
                                Region
                            </label>
                            <input name="region" type="text" class="form-control @error('region') is-invalid @enderror"
                                value="{{ old('region') }}" />
                            @error('region')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class=" w-25">
                            <label class="label">
                                Expire-Date
                            </label>
                            <input name="expires_at" type="date"
                                class="form-control @error('expires_at') is-invalid @enderror"
                                value="{{ old('expires_at') }}" />
                            @error('expires_at')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-25">
                            <label class="label">
                                Contract
                            </label>
                            <div class="form-check">
                                <input class="form-check-input @error('contract') is-invalid @enderror" type="radio"
                                    name="contract" id="contract" value="sale"  {{(old('contract') == 'sale') ? 'checked' : ''}} />
                                <label class="form-check-label"> Sale </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input  @error('contract') is-invalid @enderror" type="radio"
                                    name="contract" id="contract" value="rent" {{(old('contract') == 'rent') ? 'checked' : ''}} />
                                <label class="form-check-label"> Rent </label>
                            </div>
                            @error('contract')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-25">
                            <label class="label">
                                Facilities
                            </label>
                            <select name="facility_id[]" class="form-select @error('facility_id') is-invalid @enderror"
                                id="multiple-select-field" data-placeholder="Choose Facilities..." multiple>
                                {{-- <option value="">Choose Facilities...</option> --}}
                                @foreach (\App\Models\Facility::all() as $facility)
                                    <option value="{{ $facility->id }}" {{ (collect(old('facility_id'))->contains($facility->id)) ? 'selected':'' }}>{{ $facility->name }}</option>
                                @endforeach
                            </select>
                            @error('facility_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="w-100">
                            <label class="label">
                                Description
                            </label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Write Description..."></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button style="width:40%;" class="btn btn-outline-primary  btn-block mt-5 mx-auto" type="submit">
                        <i class="fa fa-paper-plane">Create</i>
                    </button>
                </div>
            </div>
        </form>
        <!-- /.card-body -->

    </div>
@endsection
