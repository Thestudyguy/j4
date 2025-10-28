<aside class="main-sidebar sidebar-info-primary elevation-1 fixed" style="position: fixed;background: #0A2A51;">
    <center>
        <img class="brand-image" src="{{ asset('images/j4.png') }}" alt="" style="width: 50%">
    </center>
    <a href="" class="brand-link" style="text-decoration: none;"></a>
    {{-- <div style="
    position: fixed;
    bottom: 20px;
    left: 20px;
    background: #fffbe6;
    border: 1px solid #ccc;
    padding: 12px 16px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    font-family: Arial, sans-serif;
    font-size: 14px;
    z-index: 9999;">
    <code class="text-info fw-bold">Current Tasks</code><br>
    <code class="text-dark fw-bold">Login: test, 5UjKBrrwoe</code><br>
    <strong>Dentist</strong>
    <ol style="margin: 8px 0 0 20px; padding: 0;">
        <li>View Patient Record Information and appointment </li>
        <li>Number of appointments.</li>
        <li>Add and edit patient medical records.</li>
        <li>Monitor completed, ongoing, and upcoming procedures.</li>
        <li>Add follow-up checkups.</li>
    </ol>
</div> --}}
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column dashboard-nav-link" data-widget="treeview" role="menu" data-accordion="false">
            @if (Auth::check() && Auth::user()->Role === 'Front Desk')
                <li class="nav-item">
                        <a href="{{ route('appointments') }}" class="nav-link">
                            <i class="nav-icon fas fa-notes-medical"></i>
                            <p class="text-sm">{{ __('Appointments') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p class="text-sm">{{ __('Dashboard') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('patients') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p class="text-sm">{{ __('Patients') }}</p>
                        </a>
                    </li>
                    
    @else
    <!--  -->
                    @endif

                @if (Auth::check() && Auth::user()->Role == 'patient' && (Auth::user()->is_first_login == false &&  Auth::user()->is_set_up_complete == true))
                    {{-- Only show this if the user is a patient --}}
                    <li class="nav-item">
                        <a href="{{ route('patient-appointments-page') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p class="text-sm">{{ __('Profile') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('new-appointment-form') }}" class="nav-link">
                            <i class="nav-icon fas fa-notes-medical"></i>
                            <p class="text-sm">{{ __('New Appointment') }}</p>
                        </a>
                    </li>

                

                @elseif (Auth::check() && Auth::user()->Role !== 'patient' && Auth::user()->Role !== 'Dentist' && Auth::user()->Role !== 'Front Desk')
                    {{-- Show these for non-patient and non-dentist roles --}}
                    <li class="nav-item">
                        <a href="{{ route('appointments') }}" class="nav-link">
                            <i class="nav-icon fas fa-notes-medical"style="color: white;"></i>
                            <p class="text-sm">{{ __('Appointments') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"style="color: white;"></i>
                            <p class="text-sm">{{ __('Dashboard') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('services-dashboard') }}" class="nav-link">
                            <i class="nav-icon fa fa-file-invoice"style="color: white;"></i>
                            <p class="text-sm">{{ __('Services') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('doctors') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"style="color: white;"></i>
                            <p class="text-sm">{{ __('Doctors') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('patients') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"style="color: white;"></i>
                            <p class="text-sm">{{ __('Patients') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('inventory') }}" class="nav-link">
                            <i class="nav-icon fas fa-boxes"style="color: white;"></i>
                            <p class="text-sm">{{ __('Inventory') }}</p>
                        </a>
                    </li>
                @endif

                @if (Auth::check() && Auth::user()->Role === 'Dentist')
                    {{-- Only show this for dentists --}}
                    <li class="nav-item">
                        <a href="{{ route('dentist-interface') }}" class="nav-link">
                            <i class="nav-icon fas fa-file"></i>
                            <p class="text-sm">{{ __('My appointments') }}</p>
                        </a>
                    </li>
                @endif
{{-- <li class="nav-item">
                        <a href="{{ route('dentist-interface') }}" class="nav-link">
                            <i class="nav-icon fas fa-file" style="color: white;"></i>
                            <p class="text-sm">{{ __('My appointments') }}</p>
                        </a>
                    </li> --}}
            </ul>
        </nav>
    </div>
</aside>
