<aside class="main-sidebar sidebar-info-primary elevation-1 fixed" style="position: fixed;background: #063D58;">
    <center>
        <img class="brand-image" src="{{ asset('images/dclogo.png') }}" alt="" style="width: 50%">
    </center>
    <a href="" class="brand-link" style="text-decoration: none;"></a>
    
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column dashboard-nav-link" data-widget="treeview" role="menu" data-accordion="false">

                @if (Auth::check() && Auth::user()->Role === 'patient')
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

                @elseif (Auth::check() && Auth::user()->Role !== 'patient' && Auth::user()->Role !== 'Dentist')
                    {{-- Show these for non-patient and non-dentist roles --}}
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
                        <a href="{{ route('services-dashboard') }}" class="nav-link">
                            <i class="nav-icon fa fa-file-invoice"></i>
                            <p class="text-sm">{{ __('Services') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('doctors') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p class="text-sm">{{ __('Doctors') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('patients') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p class="text-sm">{{ __('Patients') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('inventory') }}" class="nav-link">
                            <i class="nav-icon fas fa-boxes"></i>
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

            </ul>
        </nav>
    </div>
</aside>
