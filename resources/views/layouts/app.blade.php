<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
    </head>
    <body>
        <header style="background-color: black">
            <h1 style="color: white">@yield('title')</h1>
        </header>
        <section>
            @yield('content')
        </section>
    </body>
</html>