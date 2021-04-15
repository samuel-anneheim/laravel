<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel</title>
</head>
<body>
    <h1>Hello Laravel</h1>

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
    
</body>
</html>