<!doctype html>

<html lang="en">

<head>
    <title>Title here</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9,chrome=1">
    <meta name="author" content="Ammar Alakkad">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/assets/css/main.css" rel="stylesheet">

    <body>
        @section('sidebar')
            This is the master sidebar.
        @show

        <div class="container">
            {{ $content }}
        </div>
    </body>
</html>
