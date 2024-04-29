@extends('profile.layouts.sidebar')
@section('content')
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content-section')
                </div>
            </div>
        </div>
    </div>
@endsection