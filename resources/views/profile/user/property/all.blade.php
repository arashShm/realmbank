@extends('profile.user.profile')

@section('content-section')
    <div class="card p-1">
        <div class="card-header">
            <h2 class="list-title">Properties List</h2>

            <div class="card-tools d-flex">

                <div class="topnav">
                    <a href="{{ route('properties.create') }}" id="home">Add Property+</a>
                    <div class="search-container">
                        <form action="" method="GET" id="navForm">
                            <button class="btn" type="submit"><i class="fa fa-search">Go</i></button>
                            <input type="text" placeholder="Search.." name="search" value="{{ request('search') }}">
                            <select class="selectForm form-select m-2 w-25" aria-label=".form-select-lg example"
                                name="order">
                                <option value="">OrderBy...</option>
                                <option value="recent" @if (request('order') == 'recent') selected @endif>Recent</option>
                                <option value="active" @if (request('order') == 'active') selected @endif>Active</option>
                                <option value="expired" @if (request('order') == 'expired') selected @endif>Expired</option>
                                <option value="expire_date" @if (request('order') == 'expire_date') selected @endif>Expire Date
                                </option>
                            </select>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        @foreach ($properties as $property)
            @if ($property->user->id == auth()->user()->id)
                <div class="card m-2">
                    <div class="row no-gutters">
                        <div class="col-md-3 ">
                            <img src="{{ asset($property->image) }}" class="card-img image m-2">
                        </div>
                        <div class="col-md-8 d-flex">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title fw-bold ">Contract :
                                        @if ($property->contract == 'rent')
                                            <span class="  text-primary ">{{ strtoupper($property->contract) }}</span>
                                        @else
                                            <span class="  text-success ">{{ strtoupper($property->contract) }}</span>
                                        @endif
                                    </h5>
                                </div>
                                <p class="card-text">{{ $property->description }}</p>
                                <div class="mt-3">
                                    <p class="card-text fw-bold">Plot: <span
                                            class="text-danger">{{ strtoupper($property->plot) }}</span></p>
                                    <p class="card-text fw-bold">Price: <span
                                            class="">{{ number_format($property->price) }} $</span></p>
                                </div>
                                <div class="d-flex justify-content-start mt-5">
                                    <form action="{{ route('properties.destroy', $property->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger">Delete</button>
                                    </form>
                                    <a href="{{ route('properties.edit', ['property' => $property->id]) }}"
                                        class="btn mx-1 btn-outline-success">Edit</a>
                                    <a href="{{ route('properties.show', ['property' => $property->id]) }}"
                                        class="btn mx-1 btn-outline-primary">More Info</a>
                                </div>
                            </div>
                            <div class="footer ">
                                <p class="card-text fw-bold m-1  ">Ad Created: <small class="text-muted">
                                        {{ agoTime($property->created_at) }}</small></p>
                                <p class="card-text fw-bold m-1">Ad Expires: <small class="text-muted">
                                        {{ agoTime($property->expires_at) }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        <div class="card-footer">
            {{-- {{ $users->appends('search' => request(['']))->render() }} --}}
            {{-- {{ $properties->appends(['search' => Request::get('search')])->links() }} --}}
            {{-- {{ $users->links() }} --}}
        </div>

        <!-- /.card-body -->

    </div>
@endsection
