@section('sidebar-section')
    <li>
        <a href="{{ route('admin.profile') }}">Dashboard</a>
    </li>
    <li>
        <a href="{{ route('admin.users.index') }}">Users</a>
    </li>
    <li>
        <a href="{{ route('admin.properties.index') }}">Properties</a>
    </li>
    <li>
        <a href="{{ route('admin.location.index') }}">City & Country</a>
    </li>
    <li>
        <a href="{{ route('admin.facilities.index') }}">Facilities</a>
    </li>
@endsection
