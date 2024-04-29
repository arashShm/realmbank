@extends('profile.admin.profile')

@section('content-section')
    {{-- <section style="background-color: #eee;" class="">
        <div class="container">
            <div class="row justify-content-center mb-3">
                <div class="col-md-12 col-xl-10">
                    <div class="card shadow-0 border rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-3 col-xl-3 d-flex justify-content-end mb-lg-0">
                                    <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                        <img src="{{asset($property->image)}}"
                                            class="w-100" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <h5>Quant trident shirts</h5>
                                    <div class="d-flex flex-row">
                                        <div class="text-danger mb-1 me-2">
                                            <i class="fa fa-star">1</i>
                                            <i class="fa fa-star">2</i>
                                            <i class="fa fa-star">3</i>
                                            <i class="fa fa-star">5</i>
                                        </div>
                                        <span>310</span>
                                    </div>
                                    <div class="mt-1 mb-0 text-muted small">
                                        <span>100% cotton</span>
                                        <span class="text-primary"> • </span>
                                        <span>Light weight</span>
                                        <span class="text-primary"> • </span>
                                        <span>Best finish<br /></span>
                                    </div>
                                    <div class="mb-2 text-muted small">
                                        <span>Unique design</span>
                                        <span class="text-primary"> • </span>
                                        <span>For men</span>
                                        <span class="text-primary"> • </span>
                                        <span>Casual<br /></span>
                                    </div>
                                    <p class="text-truncate mb-4 mb-md-0">
                                        There are many variations of passages of Lorem Ipsum available, but the
                                        majority have suffered alteration in some form, by injected humour, or
                                        randomised words which don't look even slightly believable.
                                    </p>
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                    <div class="d-flex flex-row align-items-center mb-1">
                                        <h4 class="mb-1 me-1">$13.99</h4>
                                        <span class="text-danger"><s>$20.99</s></span>
                                    </div>
                                    <h6 class="text-success">Free shipping</h6>
                                    <div class="d-flex flex-column mt-4">
                                        <button class="btn btn-primary btn-sm" type="button">Details</button>
                                        <button class="btn btn-outline-primary btn-sm mt-2" type="button">
                                            Add to wishlist
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <div class="card-header">
        <h2 class="list-title">Show Property {{$property->id}}</h2>
    </div>
    <div class="card showCard">
        <img src="{{ asset($property->image) }}" class="card-img-top showImage mt-1" alt="...">
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
            <a href="{{route('admin.properties.destroy' , ['property' => $property->id ])}}" class="btn btn-outline-danger">Delete</a>
            <a href="{{route('admin.properties.edit' , ['property' => $property->id ])}}" class="btn btn-outline-success">Edit</a>
        </div>
    </div>
@endsection
