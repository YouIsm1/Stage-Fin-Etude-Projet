<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Master Page</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <div class="master_page">
            @include('../Components/Menu')
            @yield('ContentComp')
        </div>
    </body>
</html>