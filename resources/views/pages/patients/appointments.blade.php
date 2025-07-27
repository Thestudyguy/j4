@extends('dashboard')

@section('content')
    <div class="container-fluid pt-5 bg-light">
        <div class="container py-4">
            <h2 class="fw-bold text-dark mb-4">My Appointments</h2>
            <div class="row bg-white p-2 rounded-2">
                <div class="col-sm-2">Date</div>
                <div class="col-sm-2">Time</div>
                <div class="col-sm-2">Dentist</div>
                <div class="col-sm-2">Procedure</div>
                <div class="col-sm-2">Status</div>
                <div class="col-sm-2"></div>
            </div>
            <div class="row bg-white p-2 rounded-2 mt-2 text-sm">
                @foreach($prepAppointment as $appt)
                <div class="col-sm-2">{{ $appt->Date }}</div>
                <div class="col-sm-2">{{ $appt->Time }}</div>
                    <div class="col-sm-2 text-sm">{{ $appt->title }} {{ $appt->dfName }} {{ $appt->dlname }}</div>
                    <div class="col-sm-2">{{ $appt->service }}</div>
                    <div class="col-sm-2"><span class="badge bg-warning">{{ $appt->status }}</span></div>
                    <div class="col-sm-2"></div>
                @endforeach

            </div>
        </div>
    </div>
    </div>
@endsection