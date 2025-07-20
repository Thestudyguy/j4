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