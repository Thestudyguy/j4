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
       
        <div id="home">@include('layouts.intro-banner')</div>
        <div id="welcome-to-j4-dc">@include('layouts.welcome-to-j4')</div>
        <div id="services">@include('layouts.services')</div>
        <div id="welcome-to-j4-dc">@include('layouts.consultation')</div>
        <!-- <div id="j4-story">@include('layouts.story')</div> -->
        <div id="j4-doctors">@include('layouts.doctors')</div>

        <div id="why-choose-j4dc">@include('layouts.why-choose-j4dc')</div>

    </div>

     @if (!View::hasSection('hideFooter'))
        @include('layouts.footer')
    @endif 
</body>

@include('components.scripts')
</html>
