<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GoLive</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>


@if (session('failedStatus'))
<script>
    let msg = '{{ session('failedStatus') }}'
      alert(msg);
</script>
@endif

@extends('layouts.app')

@section('content')
<div class="container p-4">
    <div class="row">
        <div class="col">
            <img src={{ $concert->posterUrl }} alt="Poster"
            style="width:250px;height:400px;display:block;margin-left:auto;margin-right:auto;">
        </div>
        <div class="col">
            <div style="text-align: center">
                <h2>{{ $concert->title }}</h2>
                <h4>{{ $concert->date }} {{ $concert->time }}</h4>
                <h6>{{ $concert->venue }}</h6>
            </div>
            <div class="d-flex justify-content-between">
                <h5>Performer:</h5>
                <h5>{{ $concert->performer }}</h5>
            </div>
            <div class="d-flex justify-content-between">
                <h5>Available Seat:</h5>
                <h5> {{ $availableSeat }}</h5>
            </div>
            <div class="d-flex justify-content-between">
                <h5>Price per ticket:</h5>
                <h5>{{ $concert->price }}</h5>
            </div>
            <form action="/booking/{{ $concert->id }}" method="POST" style="margin-top: 50px">
                @csrf
                <div class="d-flex flex-row-reverse">
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="seatNum" value="0"
                            onchange="changeTotalPrice(this.value);" required>
                    </div>
                    <label for="seatNum" class="col-sm-2 col-form-label">Seat:</label>
                </div>
                <div class="d-flex flex-row-reverse">
                    <span style="color:red;">
                        @error('seatNum')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="d-flex flex-row-reverse" style="margin-top: 10px;">
                    <button class="btn btn-primary" type="submit">book</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection