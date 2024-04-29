@extends('profile.admin.profile')

@section('content-section')
    <div class="card">
        <div class="card-header">
            <h2 class="list-title"> Create City & Country</h2>

        </div>

        <!-- /.card-header -->
        <div class="border d-flex flex-column">
            <div class=" m-3">
                <div class="row">
                    <form action="{{ route('admin.countries.store') }}" class="p-2 form" method="POST">
                        @csrf

                       

                        <div class="w-50 p-1">
                            <label class="label">
                                Country Name
                            </label>
                            <input name="countryName" type="text"
                                class="form-control mt-2 @error('countryName') is-invalid @enderror"
                                value="{{ old('countryName') }}" />
                            @error('countryName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button style="width:40%;" class="btn btn-outline-primary  btn-block mt-5 mx-auto" type="submit">
                            <i class="fa fa-paper-plane">Create Country</i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

    </div>
@endsection
