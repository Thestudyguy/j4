<div class="py-4">
    <h2 class="fw-bold text-dark mb-4">Appointments</h2>

    <!-- Header row -->
    <div class="row fw-semibold text-secondary py-2 border-bottom bg-light rounded-top small">
        <div class="col-sm-2">Date</div>
        <div class="col-sm-2">Time</div>
        <div class="col-sm-2">Dentist</div>
        <div class="col-sm-2">Procedure</div>
        <div class="col-sm-2">Status</div>
        {{-- <div class="col-sm-2 text-end">Action</div> --}}
    </div>

    <!-- Data rows -->
    @forelse($prepAppointment as $appt)
        <div class="row align-items-center py-2 border-bottom bg-white small hover-shadow-sm">
            <div class="col-sm-2">{{ $appt->Date }}</div>
            <div class="col-sm-2">{{ $appt->Time }}</div>
            <div class="col-sm-2">{{ $appt->title }} {{ $appt->dfName }} {{ $appt->dlname }}</div>
            <div class="col-sm-2">{{ $appt->service }}</div>
            <div class="col-sm-2">
                @php
                    $statusColor = match($appt->status) {
                        'Completed' => 'success',
                        'Pending' => 'warning',
                        'Cancelled' => 'danger',
                        default => 'secondary'
                    };
                @endphp
                <span class="badge bg-{{ $statusColor }}">{{ $appt->status }}</span>
            </div>
            {{-- <div class="col-sm-2 text-end">
                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
            </div> --}}
        </div>
    @empty
        <div class="row py-3 bg-white rounded-bottom">
            <div class="col text-center text-muted">No appointments found</div>
        </div>
    @endforelse
</div>
