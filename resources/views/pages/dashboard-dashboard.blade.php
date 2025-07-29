@extends('dashboard')
@section('content')
    <div class="container-fluid pt-5">
    <div class="row p-3">
        <h1 class="fw-bold mt-2">Dashboard</h1>

        <!-- Left side: Patient stats + Appointment Requests -->
        <div class="col-12 col-lg-8">
            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <div class="card text-center">
                        <div class="card-title p-3">Patients Today</div>
                        <div class="card-body"></div>
                        <div class="card-footer p-3 bg-white"><h1>21</h1></div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card text-center">
                        <div class="card-title p-3">Total Patients</div>
                        <div class="card-body"></div>
                        <div class="card-footer p-3 bg-white"><h1>100</h1></div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card text-center">
                        <div class="card-title p-3">Requests</div>
                        <div class="card-body"></div>
                        <div class="card-footer p-3 bg-white"><h1>56</h1></div>
                    </div>
                </div>

                <!-- Appointment Requests -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="request">Appointment Request</div>
                                <div><button class="btn btn-link">See all</button></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- <div class="col">Edrian</div>
                            <div class="col">Orthodontic</div>
                            <div class="col">July 21, 2025</div>
                            <div class="col">1:00 PM</div>
                            <div class="col text-success rounded-5">Completed</div> -->
                            @foreach ($appointments as $appt)
                            <div class="row bg-light p-3 rounded-3 small text-center">
                                <div class="col">{{ $appt->FirstName }}</div>
                                <div class="col">{{ $appt->Service }}</div>
                                <div class="col">{{ $appt->date }}</div>
                                <div class="col">{{ $appt->time }}</div>
                                <div class="col fw-semibold rounded-5">
                                    @php
                                        $status = $appt->status;
                                    @endphp

                                    <!-- Badge color coding based on status -->
                                    @if($status == 'Pending')
                                        <span class="badge bg-warning text-dark">{{ $status }}</span>
                                    @elseif($status == 'Confirmed')
                                        <span class="badge bg-success">{{ $status }}</span>
                                    @elseif($status == 'Cancelled')
                                        <span class="badge bg-danger">{{ $status }}</span>
                                    @elseif($status == 'Completed')
                                        <span class="badge bg-primary">{{ $status }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $status }}</span>
                                    @endif
                                </div>              
                            </div>
                                @endforeach
                        </div>
                    </div>
                </div>

                <!-- Payments -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="fs-4 fw-bold">Payments</div>
                            <div class="text-muted small">{{ \Carbon\Carbon::now()->format('F j, Y') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-success text-white p-3 rounded-2 fw-bold">&#8369;</div>
                                <div class="ms-3 fs-4">15,000</div>
                            </div>
                            <div class="bg-light p-3 rounded">
                                <div class="row fw-bold text-center small">
                                    <div class="col">Time</div>
                                    <div class="col">Service</div>
                                    <div class="col">Amount</div>
                                </div>
                                <!-- Add payment rows here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side: Calendar + Today's Appointments -->
        <div class="col-12 col-lg-4">
            <div class="mb-3">
                <iframe 
                    src="https://calendar.google.com/calendar/embed?src=your_calendar_id&ctz=Asia%2FManila"
                    style="border:0;" 
                    class="w-100" 
                    height="400" 
                    frameborder="0" 
                    scrolling="no">
                </iframe>
            </div>

            <div class="card">
                <div class="card-header">Today's Appointment</div>
                <div class="card-body">
                    <div class="row bg-light p-3 rounded-3 small text-center">
                        <div class="col">Edrian</div>
                        <div class="col">Orthodontic</div>
                        <div class="col text-warning opacity-75">Waiting</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    @endsection