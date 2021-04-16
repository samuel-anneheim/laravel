@extends('layouts/app')

@section('content')
    <div class="container">
        <h1>Nos annonces</h1>

        <div class="row">
            @foreach ($properties as $property)
                <div class="col-lg-3">
                    <div class="card text-center mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $property->title }}</h5>
                            <p class="card-text">{{ Str::limit($property->description,20) }}</p>
                            <a href="/annonce/{{$property->id}}" class="btn btn-primary">Voir l'annonce</a>
                        </div>
                        <div class="card-footer text-muted">
                            {{ number_format($property->price) }}€
                        </div>
                    </div>    
                </div>
            @endforeach
        </div>
    </div>
@endsection
