@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                IMAGE
            </div>
            <div class="col-lg-6">
                <h1 class="my-4 text-center">{{ $properties->title }}</h1>
                <p>{{ $properties->description }}</p>
                <p>{{ number_format($properties->price) }} €</p>
            </div>
        </div>
    </div>
@endsection