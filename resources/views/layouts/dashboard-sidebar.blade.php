<aside class="main-sidebar sidebar-info-primary elevation-1 fixed bg-white" style="position: fixed;">
    <center><img class="brand-image" src="{{ asset('images/dclogo.png') }}" alt="" style="width: 50%"></center>
    <a href="" class="brand-link" style="text-decoration: none;"></a>
    
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column dashboard-nav-link" data-widget="treeview" role="menu" data-accordion="false">

                @if (Auth::check() && Auth::user()->Role === 'patient')
                    {{-- Only show this if the user is a patient --}}
                    <li class="nav-item">
                        <a href="{{ route('patient-profile') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p class="text-sm">{{ __('Profile') }}</p>
                        </a>
                    </li>
                @elseif (Auth::check() && Auth::user()->Role !== 'patient')
                    {{-- Show all these only if not a patient --}}
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
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p class="text-sm">{{ __('Patients') }}</p>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
    </div>
</aside>
