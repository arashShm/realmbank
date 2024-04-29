@extends('profile.admin.profile')

@section('content-section')
    <div class="card">
        <div class="card-header">
            <h2 class="list-title">Edit Property {{$property->id}}</h2>


        </div>

        <!-- /.card-header -->
        <form action="{{ route('admin.properties.update' , ['property' => $property->id]) }}" method="POST" class="m-2 form" enctype="multipart/form-data"
            id="propertyForm">
            @csrf
            @method('PUT')
            <div class="border d-flex flex-column">
                <div class="p-3">
                    <div class="row w-50">
                        <img src="{{asset($property->image)}}" alt="" class="editImage">
                    </div>
                    <div class="row">
                        <div class="w-50">
                            <label class="label">
                                image
                            </label>
                            <input name="image" type="file" class="form-control @error('image') is-invalid @enderror"
                                value="{{$property->image}}" />
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
                                value="{{$property->area}}" />
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
                                <option value="residential" {{ "residential" === $property->plot ? 'selected ' : '' }}>Residential</option>
                                <option value="commercial" {{ "commercial" === $property->plot ? 'selected ' : '' }}>Commercial</option>
                                <option value="farm" {{ "farm" === $property->plot ? 'selected ' : '' }}>Farm</option>
                                <option value="villa"{{ "villa" === $property->plot ? 'selected ' : '' }}>Villa</option>
                                <option value="flat" {{ "flat" === $property->plot ? 'selected' : '' }}>Flat</option>
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
                                {{-- <option value="{{$property->user->id}}" selected disabled>{{ $property->user->firstName . ' ' . $property->user->lastName }}</option> --}}
                                @foreach (\App\Models\User::all() as $user)
                                    <option value="{{ $user->id }}" {{ $user->id === $property->user->id ? 'selected' : '' }}>
                                        {{ $user->firstName . ' ' . $user->lastName }}
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
                                value="{{$property->rooms}}" />
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
                                value="{{ $property->price }}" />
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
                                <option value="{{$property->country->id}}" selected >{{$property->country->countryName}}</option>
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
                                <option value="{{$property->city->id}}">{{$property->city->cityName}}</option>
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
                                value="{{ $property->region }}" />
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
                                value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $property->expires_at)->format('Y-m-d') }}" />
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
                                    name="contract" id="contract" value="sale"  {{($property->contract == 'rent') ? 'checked' : ''}} />
                                <label class="form-check-label"> Sale </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input  @error('contract') is-invalid @enderror" type="radio"
                                    name="contract" id="contract" value="rent" {{($property->contract == 'sale') ? 'checked' : ''}} />
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
                                id="multiple-select-field2" data-placeholder="Choose Facilities..." multiple>
                                {{-- <option value="">Choose Facilities...</option> --}}
                                @foreach (\App\Models\Facility::all() as $facility)
                                    <option value="{{ $facility->id }}" {{ in_array($facility->id, $existingSelectedValues) ? 'selected' : '' }} >{{ $facility->name }}</option>
                                @endforeach
                            </select>
                            @error('facility_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-25">
                            <label class="label">
                                Status
                            </label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror"
                                data-placeholder="Choose Facilities..." >
                                    <option value="active" {{ "active" === $property->status ? 'selected ' : '' }} >Active</option>
                                    <option value="expired" {{ "expired" === $property->status  ? 'selected ' : '' }} >Expired</option>
                                    <option value="sold" {{ "sold" === $property->status  ? 'selected ' : '' }} >Sold</option>
                            </select>
                            @error('facility_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class=" w-50">
                            <label class="label">
                                Phone
                            </label>
                            <input  type="string" class="form-control " value="{{($property->user->phone) ? $property->user->phone : 'No Phone!' }}" disabled  />
                        </div>
                        <div class="w-50">
                            <label class="label">
                                Email
                            </label>
                            <input  type="email" class="form-control " value="{{ $property->user->email }}" disabled/>               
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="w-100">
                            <label class="label">
                                Description
                            </label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Write Description...">{{$property->description}}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button style="width:40%;" class="btn btn-outline-success  btn-block mt-5 mx-auto" type="submit">
                        <i class="fa fa-paper-plane">Edit</i>
                    </button>
                </div>
            </div>
        </form>
        <!-- /.card-body -->

    </div>
@endsection
