@section('sidebar-section')
<li>
    <a href="{{ route('profile') }}">Dashboard</a>
</li>

<li>
    <a href="{{ route('users.edit' , ['user' => auth()->user()->id]) }}">Personal Information</a>
</li>


<li>
    <a href="{{ route('properties.index' , ['user' => auth()->user()->id]) }}">Properties</a>
</li>


<li class="btn btn-danger d-flex justify-content-stretch mt-4">

    <form action="{{route('users.destroy' , auth()->user()->id)}}" class="d-flex justify-content-around" method="POST" id="delete-form">
        @csrf
        @method('DELETE')

        <button id="delete-account-btn" class="btn btn-danger" onclick="event.preventDefault(); deleteAccount()">Delete Account</button>
    </form>
</li>
@endsection