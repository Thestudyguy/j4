<!DOCTYPE html>
@include('components.layout-header')

<div class="preloader flex-column justify-content-center align-items-center">
    <div class="loaders">
        <div class="load-inner load-one"></div>
        <div class="load-inner load-two"></div>
        <div class="load-inner load-three"></div>
        <span class="text">Loading...</span>
      </div>
</div>

@if (!View::hasSection('hideNavBar'))
    @include('components.navbar')
@endif

<body>
    <div>
        @yield('content')
    </div>

    @if (!View::hasSection('hideFooter'))
        @include('layouts.footer')
    @endif  
</body>

@include('components.scripts')
</html>
