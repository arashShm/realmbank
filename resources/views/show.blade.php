@extends('layouts.app')

@section('content')
<div class="card-header m-2">
    <h2 class="list-title">Show Property {{$property->id}}</h2>
</div>
<div class="card showCard m-2">
    <img src="{{ asset($property->image) }}" class="card-img-top showImage " alt="...">
    <div class="card-body">
        <h5 class="card-title text-danger">Description</h5>
        <p class="card-text">{{ $property->description }}</p>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item fw-bold">Rooms: <span>{{ $property->rooms }}</span> </li>
        <li class="list-group-item fw-bold">Price: {{ number_format($property->price) }} $</li>
        <li class="list-group-item fw-bold">Phone Number:
            @if ($property->user->phone)
                {{ $property->user->phone }}
            @else
                <span class="text-danger fw-bold">No Phone!</span>
            @endif
        </li>
        <li class="list-group-item fw-bold">email: <span class="text-success"> {{ $property->user->email }}</span></li>
        <li class="list-group-item fw-bold">
            <div class="">
                <span class="">Facility: </span>
                @foreach ($property->facilities as $facility)
                    <span class="text-primary "> • </span>
                    <span class="small fw-light ">{{ $facility->name }}</span>
                @endforeach
            </div>
        </li>
        <li class="list-group-item fw-bold">Contract: <span
                class="@if ($property->contract == 'rent') ? text-primary : text-success @endif">
                {{ ucfirst($property->contract) }}</span></li>
        <li class="list-group-item fw-bold">Plot: <span class=""> {{ ucfirst($property->plot) }}</span></li>
        <li class="list-group-item fw-bold">Area: <span class=""> {{ $property->area }} ㎡</span></li>
        <li class="list-group-item fw-bold">Country: <span class=""> {{ $property->country->countryName }}</span>
        </li>
        <li class="list-group-item fw-bold">City: <span class=""> {{ $property->city->cityName }} </span></li>
        <li class="list-group-item fw-bold">Region: <span class=""> {{ $property->region }} </span></li>
        <li class="list-group-item fw-bold">Ad Created_at: <span class="text-muted small">
                {{ agoTime($property->created_at) }} </span></li>
        <li class="list-group-item fw-bold">Ad Expires_at: <span class="text-muted small">
                {{ agoTime($property->expires_at) }} </span></li>
        <li class="list-group-item fw-bold">Status:
            @if ($property->status == 'active')
                <span class="text-success">
                    {{ ucfirst($property->status) }}
                </span>
            @elseif($property->status == 'sold')
                <span class="text-primary">
                    {{ ucfirst($property->status) }}
                </span>
            @elseif($property->status == 'expired')
                <span class="text-danger">
                    {{ ucfirst($property->status) }}
                </span>
            @endif
        </li>

    </ul>
    <div class="card-body">
        <button class="btn btn-outline-success chatButton">Contact</button>  
    </div>

</div>
@endsection