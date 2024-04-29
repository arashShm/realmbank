@extends('layouts.app')

@section('content')
    @if (auth()->user() && !session('message_displayed'))
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card logged">
                        <div class="card-header">{{ __('Dashboard') }}</div>
                        <div class="card-body  " id="">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('You are logged in!') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @php
        session(['message_displayed' => true]);
    @endphp
    @endif



    <form class="needs-validation mt-5" action="{{ route('home') }}" id="homeForm" method="GET">
        <div class="row d-flex mx-1">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="contract" value="sale"
                    {{ request('contract') == 'sale' ? 'checked' : '' }} />
                <label class="form-check-label"> Sale </label>
            </div>
            <div class="form-check">
                <input class="form-check-input " type="radio" name="contract" value="rent"
                    {{ request('contract') == 'rent' ? 'checked' : '' }} />
                <label class="form-check-label"> Rent </label>
            </div>
        </div>
        <div class="row mx-1 d-flex ">
            <div class="col-md-3 mb-3">
                {{-- <label for="validationCustom01">First name</label> --}}
                <input type="text" name="search" class="form-control" placeholder="Enter The Keyword...">
            </div>
            <div class="col-md-3 mb-3">
                {{-- <label for="validationCustom02">Last name</label> --}}
                <select name="plot" id="" class="form-control">
                    <option value="" selected>Choose a Plot...</option>
                    <option value="residential">Residetial</option>
                    <option value="commercial">Commercial</option>
                    <option value="villa">Villa</option>
                    <option value="farm">Farm</option>
                    <option value="flat">Flat</option>
                </select>
            </div>
            @php
                $rooms = \App\Models\Property::max('rooms');
            @endphp
            <div class="col-md-3 mb-3">
                <select name="rooms" id="" class="form-control">
                    <option value="">Choose Number of Rooms...</option>
                    @for ($i = $rooms; $i >= 1; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <button class="btn btn-primary btn-sm w-25 " type="submit">Submit form</button>
        </div>
    </form>

    <div class="row m-2" id="properties">
        @foreach ($properties as $property)
            <div class="card m-1" style="width: 18rem;">
                <img src="{{ $property->image }}" class="card-img-top image" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $property->user->phone ? $property->user->phone : 'No phone!' }}</h5>
                    <p class="card-text">{{ $property->description }}</p>
                    <br>
                    <p class="card-text">Status:
                        @if ($property->status == 'active')
                            <span class="text-success font-weight-bold">
                                {{ ucfirst($property->status) }}
                            </span>
                        @elseif($property->status == 'sold')
                            <span class="font-weight-bold text-primary">
                                {{ ucfirst($property->status) }}
                            </span>
                        @elseif($property->status == 'expired')
                            <span class="font-weight-bold text-danger">
                                {{ ucfirst($property->status) }}
                            </span>
                        @endif
                    </p>
                    <p class="card-text"><small class="text-muted">{{ agoTime($property->expires_at) }}</small></p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('showProperty', ['property' => $property->id]) }}" class="btn btn-primary">More
                        Info</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
