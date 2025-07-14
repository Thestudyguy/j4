@include('components.layout-header')

<body class="sidebar-mini layout-navbar-fixed bg-white">
    <div class="loader-container visually-hidden">
        <div class="loader"></div>
    </div>
    {{-- ✅ AdminLTE Preloader --}}
    
    {{-- ✅ Top Navbar --}}
        @include('layouts.dashboard-sidebar') {{-- should use .main-sidebar class inside --}}
    
    @include('layouts.dashboard-navbar') {{-- should use .main-header class inside --}}

    {{-- ✅ Sidebar --}}

    {{-- ✅ Content --}}
    <div class="content-wrapper">
        @yield('content')
    </div>

    {{-- ✅ Scripts --}}
    @include('components.scripts')
    
</body>
</html>
