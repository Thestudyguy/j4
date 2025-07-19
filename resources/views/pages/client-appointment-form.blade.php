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
        <div class="fw-semibold lead text-uppercase p-5">Appointment Form
        <button class="btn btn-primary float-right form-nav-btn-next">Next</button>
            <button class="btn btn-primary mx-2 float-right form-nav-btn-back">Back</button>
            <button class="btn btn-primary float-right form-nav-btn-finish">Finish</button>
        </div>
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
            <div class="container multi-step step-3 patient-select-service visually-hidden">
                    @include('components.client-appointment-form-select-service')
            </div>
            <div class="container multi-step step-4 patient-select-doctor visually-hidden">
                    @include('components.client-appointment-form-select-doctor')
            </div>
            <div class="container multi-step step-5 appointment-preview visually-hidden">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-4">Preview Your Appointment</h4>

            {{-- Personal Info Preview --}}
            <div class="preview-section mb-4">
                <h5>Personal Information</h5>
                <div class="p-3 border rounded bg-light" id="preview-personal-info">
                    {{-- Populate via JS or show filled values --}}
                </div>
            </div>

            {{-- Medical History Preview --}}
            <div class="preview-section mb-4">
                <h5>Medical History</h5>
                <div class="p-3 border rounded bg-light" id="preview-medical-history">
                    {{-- Populate via JS or show filled values --}}
                </div>
            </div>

            {{-- Selected Service --}}
            <div class="preview-section mb-4">
                <h5>Selected Service</h5>
                <div class="p-3 border rounded bg-light" id="preview-service">
                    {{-- Inject selected service name & description via JS --}}
                </div>
            </div>

            {{-- Selected Doctor --}}
            <div class="preview-section mb-4">
                <h5>Selected Doctor</h5>
                <div class="p-3 border rounded bg-light" id="preview-doctor">
                    {{-- Inject doctor info & image via JS --}}
                </div>
            </div>
        </div>
    </div>
</div>

            
        <!-- </form> -->
    </div>
</div>

</body>

@include('components.scripts')
</html>



