<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    @yield('header-css')
</head>
<body>
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1><a href="{{url('/')}}">MyDict</a></h1>
            </div>
            <div class="col-md-8">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="{{route('words.index')}}">Words list </a></li>
                    <li class="list-inline-item"><a href="{{route('words.create')}}">Create word </a></li>
                </ul>
            </div>
        </div>
    </div>

</header>
<main>
    @yield('content')
</main>

@yield('footer-js')
</body>
</html>