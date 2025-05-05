<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') </title>
</head>


<body @yield('background')>
    @yield('top')

    @for ($i = 0 ; $i < 10 ; $i++)
        @if ($i == 5)
            <h1>{{ $i }}</h1>
        @else
            <p>{{ $i }}</p>
        @endif
    @endfor    

</body>
</html>