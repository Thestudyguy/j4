@extends('dashboard')
@section('content')
    <div class="container-fluid pt-5">
        <div class="row p-3">
            <h1 class="fw-bold mt-2">Dashboard</h1>

            <!-- Left side: Patient stats + Appointment Requests -->
            <div class="col-12 col-lg-8">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        @php
                            // Filter appointments for today
                            $todayAppointments = $appointments->filter(function ($appt) {
                                return $appt->date == \Carbon\Carbon::now('Asia/Manila')->format('Y-m-d');
                            });

                            $todayCount = $todayAppointments->count();
                        @endphp

                        <div class="card text-center">
                            <div class="card-title p-3">Patients Today asd</div>
                            <div class="card-body"></div>
                            <div class="card-footer p-3 bg-white">
                                <h1>{{ $todayCount }}</h1>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card text-center">
                            <div class="card-title p-3">Total Patients</div>
                            <div class="card-body"></div>
                            <div class="card-footer p-3 bg-white">
                                <h1>{{ number_format($totalPatient) }}</h1>
                            </div>
                        </div>
                    </div>
                    @php
                        // Filter appointments that are NOT completed
                        $pendingAppointments = $appointments->where('status', '!=', 'completed');
                        $pendingCount = $pendingAppointments->count();
                    @endphp

                    {{-- <div class="col-12 col-md-4">
                        <div class="card text-center">
                            <div class="card-title p-3">Requests</div>
                            <div class="card-body"></div>
                            <div class="card-footer p-3 bg-white">
                                <h1>{{ $pendingCount }}</h1>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Appointment Requests -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="request">Inventory Status</div>
                                    {{-- <div><button class="btn btn-link"><a href="{{ route('appointments') }}">See
                                                all</a></button></div> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row p-2 rounded-5">
                                    <div class="col-sm-2">
                                        <span class="fw-semibold text-muted small">Product Name</span>
                                    </div>
                                    <div class="col-sm-2">
                                        <span class="fw-semibold text-muted small">Category</span>
                                    </div>
                                    <div class="col-sm-2">
                                        <span class="fw-semibold text-muted small">On Hand</span>
                                    </div>
                                    <div class="col-sm-2">
                                        <span class="fw-semibold text-muted small">Status</span>
                                    </div>
                                    <div class="col-sm-2">
                                        <span class="fw-semibold text-muted small">Time Stamps</span>
                                    </div>
                                </div>
                                <!-- <div class="col">Edrian</div>
                                        <div class="col">Orthodontic</div>
                                        <div class="col">July 21, 2025</div>
                                        <div class="col">1:00 PM</div>
                                        <div class="col text-success rounded-5">Completed</div> -->
                                @foreach ($inventory as $items)
                                    @php
                                        $maxStock = $items->max_stock ?? 100;
                                        $lowStockThreshold = $maxStock * 0.15;
                                        $isOutOfStock = $items->on_hand == 0;
                                        $isLowStock = !$isOutOfStock && $items->on_hand <= $lowStockThreshold;
                                    @endphp

                                    @if ($isOutOfStock || $isLowStock)
                                        <div class="row inventory-row bg-light mt-1">
                                            <div class="col-sm-2">
                                                <span class="fw-semibold text-muted small">{{ $items->item_name }}</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="fw-semibold text-muted small">{{ $items->category }}</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <span
                                                    class="fw-semibold small {{ $isOutOfStock ? 'text-danger fw-bold' : 'text-warning fw-semibold' }}">
                                                    {{ $items->on_hand }}
                                                </span>
                                            </div>
                                            <div class="col-sm-2">
                                                @if ($isOutOfStock)
                                                    <small class="text-danger fw-bold small">Out of Stock</small>
                                                @elseif($isLowStock)
                                                    <small class="text-warning fw-semibold">Low</small>
                                                @endif
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="fw-semibold small text-muted">
                                                    {{ $items->created_at->timezone('Asia/Manila')->format('F j, Y g:i A') }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
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
                                {{-- <div class="d-flex align-items-center mb-3">
                                <div class="bg-success text-white p-3 rounded-2 fw-bold">&#8369;</div>
                                <div class="ms-3 fs-4">15,000</div>
                            </div> --}}
                                <div class="bg-light p-3 rounded">
                                    <div class="row fw-bold bg-white small mb-2">
                                        <div class="col">Patient</div>
                                        <div class="col">Date</div>
                                        <div class="col">Service</div>
                                        <div class="col">Amount</div>
                                    </div>
                                    @foreach ($appointments as $appt)
                                        <div class="row small mt-2 bg-white rounded-5 p-3">
                                            <div class="col">{{ $appt->FirstName }}</div>
                                            <div class="col">{{ $appt->date }}</div>
                                            <div class="col">{{ $appt->Service }}</div>
                                            <div class="col">{{ $appt->Price }}</div>
                                        </div>
                                    @endforeach
                                    <!-- Add payment rows here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side: Calendar + Today's Appointments -->
            <div class="col-12 col-lg-4">


                @php
                    use Carbon\Carbon;
                    $today = Carbon::today()->toDateString();
                @endphp

                <div class="card">
                    <div class="card-header">Today's Appointments</div>
                    <div class="card-body">
                        @php
                            $todaysAppointments = $appointments->filter(function ($appt) use ($today) {
                                return $appt->date === $today;
                            });
                        @endphp

                        @forelse ($todaysAppointments as $appt)
                            @php
                                switch (strtolower($appt->status)) {
                                    case 'waiting':
                                        $statusClass = 'text-warning opacity-75';
                                        break;
                                    case 'ongoing':
                                        $statusClass = 'text-primary';
                                        break;
                                    case 'completed':
                                        $statusClass = 'text-success';
                                        break;
                                    case 'cancelled':
                                        $statusClass = 'text-danger';
                                        break;
                                    default:
                                        $statusClass = 'text-secondary';
                                }
                            @endphp

                            <div class="row bg-light p-3 rounded-3 small text-center mb-2 shadow-sm">
                                <div class="col fw-semibold">{{ $appt->FirstName }}</div>
                                <div class="col">{{ $appt->Service }}</div>
                                <div class="col">{{ $appt->time }}</div>
                                {{-- <div class="col {{ $statusClass }}">{{ ucfirst($appt->status) }}</div> --}}
                            </div>
                        @empty
                            <p class="text-center text-muted m-0">No appointments today.</p>
                        @endforelse


                    </div>
                </div>
                <div class="mb-3">
                    <iframe src="https://calendar.google.com/calendar/embed?src=your_calendar_id&ctz=Asia%2FManila"
                        style="border:0;" class="w-100" height="400" frameborder="0" scrolling="no">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
