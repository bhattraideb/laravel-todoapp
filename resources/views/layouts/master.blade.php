<!DOCTYPE HTML>
<html lang="en-US" dir="ltr">
@include('partials._header')
@yield('styles')

<body>
<div class="limiter">
    @include('partials._navbar')
    <main role="main" class="container">
        @yield('content')
    </main>

</div>
@include('partials._footer')
@include('partials._scripts')
@yield('scripts')
</body>
</html>

