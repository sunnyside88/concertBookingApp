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
                            href="{{ url('/user/history') }}">Booking History</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection