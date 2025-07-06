<aside class="main-sidebar sidebar-info-primary elevation-1 fixed bg-white" style="position: fixed;">
    <center><img class="brand-image" src="{{ asset('images/dclogo.png') }}" alt="" style="width: 50%"></center>
    <a href="" class="brand-link" style="text-decoration: none;">
        {{-- <center><span class="brand-text" style="color: #20536B;">{{ __('J4 Dental Clinic') }}</span></center> --}}
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column dashboard-nav-link" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                        <a href="{{route('dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <i class="fa-solid fa-gauge"></i>
                            <p class="text-sm">
                                {{ __('Dashboard') }}
                            </p>
                        </a>
                </li>
                <li class="nav-item">
                        <a href="{{route('services-dashboard')}}" class="nav-link">
                            <i class="nav-icon fa fa-file-invoice"></i>
                            <i class="fa-solid fa-gauge"></i>
                            <p class="text-sm">
                                {{ __('Settings') }}
                            </p>
                        </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>