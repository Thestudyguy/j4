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
    <!-- Loader Overlay -->
<div class="loader-overlay visually-hidden">
  <div class="d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="loader"></div>
  </div>
</div>
<div class="container-fluid bg-white rounded">
    <div class="row form-cotainer">
        {{-- <p class="fw-semibold text-lg">Book an Appointment</p>
        @include('components.client-form-header')
        <div class="col-sm-12 forms">
            <div class="multi-step step-1 personal-info">
                @include('components.client-appointment-form-personal-info')
            </div>
            <div class="multi-step step-2 medical-history visually-hidden">
                @include('components.client-appointment-form-medical-history')
            </div>
            <div class="multi-step step-3 client-signature visually-hidden">
                @include('components.client-appointment-form-signature')
            </div>
            <div class="multi-step step-4 client-signature visually-hidden">
                preview here
            </div>
        </div>
        <div class="button-container">
            <button class="btn btn-primary float-end next-form-btn">Next</button>
            <button class="btn btn-secondary mx-2 float-end visually-hidden">Back</button>
            <button class="btn btn-info mx-2 float-end visually-hidden">Finish</button>
        </div> --}}

        <div class="row border">
            <div class="col-sm-12 p-5">
            please fill all required fields
            </div>
            <div class="col-sm-6 p-5">
                
                <div class="row  pr-5">
                    <div class="col-sm-12">
                        @include('components.client-appointment-form-personal-info')
                    </div>
                    {{-- <hr style="border-top: 15px solid rgb(0, 0, 0); height: 1px;"> --}}
                    <div class="col-sm-12">
                        {{-- @include('components.client-appointment-form-medical-history') --}}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row border-left">
                    <div class="col-sm-12 p-5">
                        @include('components.client-appointment-form-medical-history')
                    </div>
                </div>
            </div>
            <div class="col-sm-12 p-5 d-flex justify-content-center">
            @include('components.client-appointment-form-signature')
            </div>
        </div>
        {{-- <button class="btn btn-info btn-sm float-end">Finish</button> --}}
    </div>
</div>

</body>

@include('components.scripts')
</html>



