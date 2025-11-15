<nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
    <ul class="navbar-nav">
        <li class="nav-item px-3">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" style="color: #063D58; font-weight: bold; background: transparent;"
                href="{{ route('dashboard') }}" style="font-weight: 900;">
                {{ __('J4 Dental Clinic') }}
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        @if (Auth::user()->Role !== 'patient')
            
        <li class="nav-item dropdown mr-3 mt-2 position-relative" id="notifBtn">
    <i class="bi bi-bell" style="font-size: 1.3rem; cursor: pointer;"></i>

    <span class="badge badge-danger visually-hidden" style="position: absolute; top: 0; right: 0; font-size: 0.6rem;">
        3
    </span>

    <!-- Manual dropdown -->
    <div id="notifDropdown" 
     style="
        display: none;
        position: absolute;
        top: 30px;
        right: 0;
        width: 250px;
        max-height: 180px; /* enough for 3 items */
        overflow-y: auto;  /* scroll after 3 items */
        background: white;
        border: 1px solid #ddd;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        z-index: 1000;
     ">

    <div class="notif-item" style="padding: 8px 10px; border-bottom: 1px solid #eee; cursor: pointer;">
        <div style="font-weight: 600;">Appointment Scheduled</div>
        <div style="font-size: 0.85rem; color: #555;">
            General Checkup • Nov 20, 2025 — 2:00 PM
        </div>
        <div style="font-size: 0.75rem; color: #888;">
            Created: Nov 18, 2025 at 9:30 AM
        </div>
    </div>

</div>


</li>
        @endif


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
