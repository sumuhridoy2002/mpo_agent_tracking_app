<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('layouts.partials.header')

    @include('layouts.partials.topbar')
    @include('layouts.partials.sidebar')

    <main id="main" class="main">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

</html>