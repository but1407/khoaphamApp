<!DOCTYPE html>
<html lang="en">
    <head>
        @include('main.components.head')
    </head>
    <body class="">

        @include('main.components.header')

        @include('main.components.cart')
        @yield('content')

        
        @include('main.components.footer')


    </body>

</html>
