<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title")</title>
    @vite(["resources/css/app.css", "resources/sass/app.scss", "resources/js/app.js"])
    <style>
        .container:nth-child(1) {
            margin-top: 100px
        }
    </style>
</head>

<body>
    <div class="container position-relative">
        @include("layout.flashMessage")
        @include("layout.header")
        @include("layout.errorFloat")
        @yield("main")
    </div>
    @yield("footer")
</body>

</html>
