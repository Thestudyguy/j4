<div class="modal fade" id="client-appointment-form" tabindex="-1" aria-labelledby="clientAppointmentFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="m-0 p-0">
            <h5 class="modal-title" id="clientAppointmentFormLabel">{{__('Book an Appointment')}}</h5>
            <p class="text-muted">{{__('Please fill out the form below to book an appointment')}}</p>
        </div>
            {{-- <h5 class="modal-title" id="clientAppointmentFormLabel">{{__('Book an Appointment')}}</h5> --}}
            {{-- <p class="text-muted">{{__('Please fill out the form below to book an appointment')}}</p> --}}
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-dark">
        <form action="" class="client-form">
  <div class="row">
    <div class="col">
      <div class="mb-3">
        <label for="firstName" class="form-label">First Name</label>
        <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Enter first name">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
      </div>
    </div>
    <div class="col">
      <div class="mb-3">
        <label for="lastName" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Enter last name">
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone number">
      </div>
    </div>
  </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary fw-bold rounded-0">{{__('Submit')}}</button>
        <button type="button" class="btn btn-secondary rounded-0 fw-bold" data-bs-dismiss="modal">{{__('Close')}}</button>
      </div>
    </div>
  </div>
</div>
