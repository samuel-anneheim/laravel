{{-- On va étendre le fichier resources/views/layouts/app.blade.php --}}
{{-- Laravle compren que layouts.app est layouts/app --}}
@extends('layouts.app')

{{-- On met le contenu suivant ddans le tield content --}}
@section('content')
    <h1>Hello {{$name}}</h1>

    <ul>
        @foreach ($bibis as $index => $bibi)
            @dump($loop)
            <li>{{$bibi}}</li>
        @endforeach
    </ul>

    <h2>Blade simplifie le PHP</h2>

    <?= date('d/m/y') ?>
    {{date('d/m/y')}}

    <h2>If en blade</h2>
    @if(1 === 1)
        je suis un if
    @endif

    <h2>Boucle en balde</h2>
    @for ($i = 0; $i < 10; $i++)
        {{ $i }}
    @endfor

    <h2>Protection XSS en blade</h2>
    {{'<scripts>alert("toto")</scripts>'}}
    {!! '<h1>Pas de protection XSS</h1>' !!}
@endsection
