{{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand mx-5 px-5" href="#">
    <img src="{{ asset('images/dclogo.png') }}" style="width: 30%; height: auto;" alt="">
  </a>
  <button class="navbar-toggler mx-3" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">

  <i class="fas fa-bars text-white fs-3"></i>
</button>


  <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent" style="font-size: 18px;">
    <ul class="navbar-nav">
      <li class="nav-item active mx-3">
        <a class="nav-link text-dark" style="color: #fff;" href="#">{{ __('Home') }}</a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link text-dark" style="color: #fff;" href="#about">{{ __('About Us') }}</a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link text-dark" style="color: #fff;" href="#services">{{ __('Services') }}</a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link text-dark" style="color: #fff;" href="#contact">{{ __('Contact Us') }}</a>
      </li>
    </ul>
  </div>
</nav> --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="row">
    <div class="col">
      <a class="navbar-brand mx-5 px-5" href="{{route('default')}}">
        <img src="{{ asset('images/dclogo.png') }}" style="width: 30%; height: auto;" alt="">
      </a>
    </div>
    <div class="container-fluid col d-flex flex-row align-items-center float-left justify-content-center" style="font-size: 18px;">
      <ul class="navbar-nav">
      <li class="nav-item active mx-3">
       <a href="{{ route('register') }}">
            
         <button style="background-color: #20536B; font-size: 12px;" class="text-white btn rounded-5 p-2 mx-2 px-4">
            BOOK AN APPOINTMENT
        </button>
       </a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link text-dark" style="color: #fff;" href="#about">{{ __('About Us') }}</a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link text-dark" style="color: #fff;" href="#services">{{ __('Services') }}</a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link text-dark" style="color: #fff;" href="#contact">{{ __('Contact Us') }}</a>
      </li>
      {{-- <li class="nav-item mx-3">
        <a class="nav-link text-dark" style="color: #fff;" href="#">{{ __('LogIn') }}</a>
      </li> --}}
    </ul>
    </div>
  </div>
</nav>