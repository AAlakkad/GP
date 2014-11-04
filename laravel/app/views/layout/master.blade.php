<!doctype html>
<html lang="en">

<head>
    <title>Title here</title>

    <meta charset="utf-8">
    <meta name="author" content="Ammar Alakkad">
    <meta http-equiv="X-UA-Compatible" content="IE=9,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/assets/css/main.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        @include('layout.navbar')

        <div class="content">
            {{ $content }}
        </div>

        @include('layout.footer')
    </div>

</body>
</html>
