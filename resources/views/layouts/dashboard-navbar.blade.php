<nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
    <ul class="navbar-nav">
       
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

    @if ($totalNotif > 0)
    <span class="badge badge-danger"
          style="position:absolute; top:-5px; right:-5px; padding:3px 6px; font-size:0.7rem;">
        {{ $totalNotif }}
    </span>
    @endif

    <div id="notifDropdown" 
         style="
            display: none;
            position: absolute;
            top: 30px;
            right: 0;
            width: 260px;
            max-height: 280px;
            overflow-y: auto;
            background: white;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
         ">

        {{-- ==================== APPOINTMENT NOTIFICATIONS ==================== --}}
        @if ($appointmentsNotif->count() > 0)
        <div style="padding:6px 10px; font-weight:600; font-size:0.8rem; color:#333; border-bottom:1px solid #eee;">
            <i class="bi bi-calendar-check"></i> Appointment Alerts
        </div>
        @endif

        @foreach ($appointmentsNotif as $appt)
            @php
                $apptDate = \Carbon\Carbon::parse($appt->date);

                $created = null;

                if (!empty($appt->appointment_created)) {
                    try {
                        $created = \Carbon\Carbon::parse($appt->appointment_created);
                    } catch (\Exception $e) {}
                }

                $isToday = $apptDate->isToday();
                $isNew = $created ? $created->diffInMinutes(now()) <= 10 : false;

                $bgClass = $isNew 
                    ? 'bg-success text-white' 
                    : ($isToday ? 'bg-warning text-dark' : '');
            @endphp

            <div class="notif-item {{ $bgClass }}"
                 style="padding: 8px 10px; border-bottom: 1px solid #eee; cursor: pointer;">
                <div style="font-weight: 600;">Appointment Scheduled</div>

                <div style="font-size: 0.85rem;">
                    {{ $appt->Service }} • {{ $apptDate->format('M d, Y') }} — 
                    {{ \Carbon\Carbon::parse($appt->time)->format('g:i A') }}
                </div>

                <div style="font-size: 0.75rem; opacity: 0.8;">
                    Created: {{ $isNew ? 'New' : $created?->diffForHumans() }}
                </div>
            </div>
        @endforeach



        {{-- ==================== INVENTORY NOTIFICATIONS ==================== --}}
        @if (!empty($inventoryNotifications))
        <div style="padding:6px 10px; font-weight:600; font-size:0.8rem; color:#333; border-bottom:1px solid #eee;">
            <i class="bi bi-box-seam"></i> Inventory Alerts
        </div>
        @endif

        @foreach ($inventoryNotifications as $inv)
            <div class="notif-item {{ $inv['highlight'] }}"
                 style="padding: 8px 10px; border-bottom: 1px solid #eee; cursor: pointer;">
                <div style="font-weight: 600;">
                    <i class="bi bi-exclamation-triangle"></i> {{ ucfirst(str_replace('_',' ', $inv['type'])) }}
                </div>

                <div style="font-size: 0.85rem;">
                    {{ $inv['message'] }}
                </div>
            </div>
        @endforeach

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

@if(Auth::user()->Role == 'patient' && Auth::user()->is_set_up_complete === 0)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Trigger pushMenu collapse
            const sidebarToggle = document.querySelector('[data-widget="pushmenu"]');
            if (sidebarToggle) {
                sidebarToggle.click(); // simulate click to collapse
            }
        });
    </script>
@endif