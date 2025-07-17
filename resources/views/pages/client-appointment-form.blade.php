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

<body>
<div class="loader-overlay visually-hidden">
  <div class="d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="loader"></div>
  </div>
</div>
<div class="container-fluid bg-white rounded d-flex align-items-center justify-content-center flex-column">
    <div class="row form-cotainer container">
        <!-- <div class="form-title lead fw-bold">form title</div> -->
        <div class="fw-semibold lead text-uppercase p-5">Appointment Form</div>
        <div class="d-flex align-items-center justify-content-center">
            <div class="col-sm-2 p-2 bg-info text-sm p-0 m-0 form-step-indicator" style="border-top-right-radius: 100px; border-bottom-right-radius: 100px;">Personal Info</div>
            <div class="col-sm-2 p-2 bg-secondary text-sm p-0 m-0 form-step-indicator" style="border-top-right-radius: 100px; border-bottom-right-radius: 100px;">Medical History</div>
            <div class="col-sm-2 p-2 bg-secondary text-sm p-0 m-0 form-step-indicator" style="border-top-right-radius: 100px; border-bottom-right-radius: 100px;">Services</div>
            <div class="col-sm-2 p-2 bg-secondary text-sm p-0 m-0 form-step-indicator" style="border-top-right-radius: 100px; border-bottom-right-radius: 100px;">Choose a Doctor</div>
            <div class="col-sm-2 p-2 bg-secondary text-sm p-0 m-0 form-step-indicator" style="border-top-right-radius: 100px; border-bottom-right-radius: 100px;">Application Preview</div>
        </div>
    </div>
    <div class="form-container-sheesh">
        <!-- <form action="" class="p-5 appointment-form-multi-step-container"> -->
            <div class="container multi-step step-1 personal-info">
                    @include('components.client-appointment-form-personal-info')
            </div>
            <div class="container multi-step step-2 medical-history visually-hidden">
                    @include('components.client-appointment-form-medical-history')
            </div>
            <button class="btn btn-primary float-right form-nav-btn-next">Next</button>
            <button class="btn btn-primary mx-2 float-right form-nav-btn-back">Back</button>
            <button class="btn btn-primary float-right form-nav-btn-finish">Finish</button>
        <!-- </form> -->
    </div>
</div>

</body>

@include('components.scripts')
</html>



