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
@extends('layouts.app')

@if (session('successfulStatus'))
<script>
    let msg = '{{ session('successfulStatus') }}'
      alert(msg);
</script>
@endif

@section('content')
<div class="container">
    @for ($i = 0; $i < count($concerts); $i += 3)
        <div class="row">

            @if (isset($concerts[$i]))
                <div class="col p-3">
                    <div class="card p-3" style="max-width: 250px;max-height:500px">
                        <img src={{ $concerts[$i]->posterUrl }} alt="Poster"
                            style="width:180px;height:240px;display: block;margin-left: auto; margin-right: auto;">
                        <h5 style="text-align: center">{{ $concerts[$i]->title }}</h5>
                        <div class="d-flex flex-column">
                            <h6 style="text-align: center">Performer</h6>
                            <cite style="margin-bottom: 5px;text-align: center">{{ $concerts[$i]->title }}</cite>
                        </div>
                        <div class="d-flex flex-column ">
                            <h6 style="text-align: center">Date</h6>
                            <cite style="margin-bottom: 5px;text-align: center">{{ $concerts[$i]->date }}</cite>
                            <h6 style="text-align: center">Time</h6>
                            <cite style="margin-bottom: 5px;text-align: center">{{ $concerts[$i]->time }}</cite>
                        </div>
                        <a class="btn btn-primary" href="/booking/{{ $concerts[$i]->id }}">
                            <i class="bi bi-cart4"></i>
                            {{ $concerts[$i]->price }}
                        </a>
                    </div>
                </div>
            @endif

            @if (isset($concerts[$i + 1]))
                <div class="col p-3">
                    <div class="card p-3" style="max-width: 250px;max-height:500px">
                        <img src={{ $concerts[$i + 1]->posterUrl }} alt="Poster"
                            style="width:180px;height:240px;display: block;margin-left: auto; margin-right: auto;">
                        <h5 style="text-align: center">{{ $concerts[$i + 1]->title }}</h5>
                        <div class="d-flex flex-column">
                            <h6 style="text-align: center">Performer</h6>
                            <cite style="margin-bottom: 5px;text-align: center">{{ $concerts[$i + 1]->title }}</cite>
                        </div>
                        <div class="d-flex flex-column">
                            <h6 style="text-align: center">Date</h6>
                            <cite style="margin-bottom: 5px;text-align: center">{{ $concerts[$i + 1]->date }}</cite>
                            <h6 style="text-align: center">Time</h6>
                            <cite style="margin-bottom: 5px;text-align: center">{{ $concerts[$i + 1]->time }}</cite>
                        </div>
                        <a class="btn btn-primary" href="/booking/{{ $concerts[$i + 1]->id }}">
                            <i class="bi bi-cart4"></i>
                            {{ $concerts[$i + 1]->price }}
                        </a>
                    </div>
                </div>
            @endif

            @if (isset($concerts[$i + 2]))
                <div class="col p-3">
                    <div class="card p-3" style="max-width: 250px;max-height:500px">
                        <img src={{ $concerts[$i + 2]->posterUrl }} alt="Poster"
                            style="width:180px;height:240px;display: block;margin-left: auto; margin-right: auto;">
                        <h5 style="text-align: center">{{ $concerts[$i + 2]->title }}</h5>
                        <div class="d-flex flex-column">
                            <h6 style="text-align: center">Performer</h6>
                            <cite style="margin-bottom: 5px;text-align: center">{{ $concerts[$i + 2]->title }}</cite>
                        </div>
                        <div class="d-flex flex-column">
                            <h6 style="text-align: center">Date</h6>
                            <cite style="margin-bottom: 5px;text-align: center">{{ $concerts[$i + 2]->date }}</cite>
                            <h6 style="text-align: center">Time</h6>
                            <cite style="margin-bottom: 5px;text-align: center">{{ $concerts[$i + 2]->time }}</cite>
                        </div>
                        <a class="btn btn-primary" href="/booking/{{ $concerts[$i + 2]->id }}">
                            <i class="bi bi-cart4"></i>
                            {{ $concerts[$i + 2]->price }}
                        </a>
                    </div>
                </div>
            @endif

        </div>
    @endfor

</div>
@endsection