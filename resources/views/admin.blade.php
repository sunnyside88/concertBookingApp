@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex">
        <div class="col-md-3">
            <div class="card d-flex" style="margin: 10px">
                <div class="card-body align-items-center text-center justify-content-center">
                    <img
                        src="https://img.icons8.com/external-kiranshastry-lineal-color-kiranshastry/128/000000/external-event-camping-kiranshastry-lineal-color-kiranshastry-1.png" />
                    <button type="button" class="btn btn-outline-secondary"><a style="color:black;text-decoration: none;"
                            href="{{ url('/admin/concerts') }}">Manage Concerts</a>
                    </button>
                    {{-- <div id="concert-modal"></div> --}}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card d-flex" style="margin: 10px">
                <div class="card-body align-items-center text-center justify-content-center">
                    <img
                        src="https://img.icons8.com/external-kiranshastry-lineal-color-kiranshastry/128/4a90e2/external-user-advertising-kiranshastry-lineal-color-kiranshastry-4.png"/>
                    <button type="button" class="btn btn-outline-secondary"><a style="color:black;text-decoration: none;"
                            href="{{ url('/admin/users') }}">Manage Users</a>
                    </button>
                    {{-- <div id="concert-modal"></div> --}}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card d-flex" style="margin: 10px">
                <div class="card-body align-items-center text-center justify-content-center">
                    <img
                        src="https://img.icons8.com/external-kiranshastry-lineal-color-kiranshastry/128/000000/external-ticket-circus-kiranshastry-lineal-color-kiranshastry.png"/>
                    <button type="button" class="btn btn-outline-secondary"><a style="color:black;text-decoration: none;"
                            href="{{ url('/admin/bookings') }}">Manage Bookings</a>
                    </button>
                    {{-- <div id="concert-modal"></div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection