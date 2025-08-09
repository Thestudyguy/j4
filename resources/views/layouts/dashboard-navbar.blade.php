<nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
    <ul class="navbar-nav">
        <li class="nav-item px-3">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" style="color: #063D58; font-weight: bold; background: transparent;" href="{{ route('dashboard') }}" style="font-weight: 900;">
                {{ __('J4 Dental Clinic') }}
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown mr-3">
            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
               Hello, {{ Auth::user()->FirstName }}
@if (Auth::user()->Role !== 'patient')
    <sup>({{ Auth::user()->Role }})</sup>
@endif
            </a>
        </li>
        <li class="nav-item mr-3">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>