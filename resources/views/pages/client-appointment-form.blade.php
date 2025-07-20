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
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <div class="col-sm-2 p-2 bg-info text-sm p-0 m-0 form-step-indicator"
                    style="border-top-right-radius: 100px; border-bottom-right-radius: 100px;">Personal Info</div>
                <div class="col-sm-2 p-2 bg-secondary text-sm p-0 m-0 form-step-indicator"
                    style="border-top-right-radius: 100px; border-bottom-right-radius: 100px;">Medical History</div>
                <div class="col-sm-2 p-2 bg-secondary text-sm p-0 m-0 form-step-indicator"
                    style="border-top-right-radius: 100px; border-bottom-right-radius: 100px;">Services</div>
                <div class="col-sm-2 p-2 bg-secondary text-sm p-0 m-0 form-step-indicator"
                    style="border-top-right-radius: 100px; border-bottom-right-radius: 100px;">Choose a Doctor</div>
                <div class="col-sm-2 p-2 bg-secondary text-sm p-0 m-0 form-step-indicator"
                    style="border-top-right-radius: 100px; border-bottom-right-radius: 100px;">Application Preview</div>
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
                <div class="container p-4">
                    <h4 class="fw-bold text-center mb-4">📋 Appointment Summary</h4>

                    <!-- Personal Information -->
                    <div class="preview-section mb-4">
                        <h5 class="text-primary">👤 Personal Information</h5>
                        <div id="preview-personal-info" class="p-3 border rounded bg-light"></div>
                    </div>

                </div>

                <!-- Medical History -->
                <div class="preview-section mb-4">
                    <h5 class="text-primary">🩺 Medical History</h5>
                    <div class="p-3 border rounded bg-light" id="preview-medical-history">
                        <p><strong>Healthy:</strong> <span id="preview-isHealthy">---</span></p>
                        <p><strong>Past Surgeries:</strong> <span id="preview-surgeries">---</span></p>
                        <p><strong>Allergies / Conditions:</strong> <span id="preview-conditions">---</span></p>
                        <!-- Add dynamic content with JS -->
                    </div>
                </div>

                <!-- Selected Service -->
                <div class="preview-section mb-4">
                    <h5 class="text-primary">🦷 Selected Service</h5>
                    <div class="p-3 border rounded bg-light" id="preview-service">
                        <p><strong>Service:</strong> <span id="preview-service-name">---</span></p>
                        <p><strong>Description:</strong> <span id="preview-service-desc">---</span></p>
                        <p><strong>Estimated Price:</strong> ₱<span id="preview-service-price">---</span></p>
                    </div>
                </div>

                <!-- Selected Doctor -->
                <div class="preview-section mb-4">
                    <h5 class="text-primary">👨‍⚕️ Selected Doctor</h5>
                    <div class="p-3 border rounded bg-light d-flex align-items-center" id="preview-doctor">
                        <img id="preview-doctor-image" src="#" alt="Doctor Image" class="img-thumbnail me-3"
                            style="width: 80px; height: 80px; object-fit: cover;">
                        <div>
                            <p><strong>Name:</strong> <span id="preview-doctor-name">---</span></p>
                            <p><strong>Specialty:</strong> <span id="preview-doctor-specialty">---</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-nav-btn-container d-flex flex-row p-3 align-items-center justify-content-center">
        <button class="btn btn-primary mx-2 float-left form-nav-btn-back visually-hidden">Back</button>
        <button class="btn btn-primary float-right form-nav-btn-finish visually-hidden">Finish</button>
        <button class="btn btn-primary float-right form-nav-btn-next">Next</button>
    </div>
    </div>
    </div>

</body>

@include('components.scripts')

</html>