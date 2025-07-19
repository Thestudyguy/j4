<div class="">
    <p class="client-info fw-bold">Select Doctor</p>
    <div class="row">
        @foreach ($doctors as $doctor)
        <div class="col-sm-3 mb-4 is-doctor-dom-card-selected" id="selected-doctor-id-{{ $doctor->id }}">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 text-sm">
                        {{ $doctor->ProfessionalTitle ?? '' }} {{ $doctor->FirstName }} {{ $doctor->MiddleName }} {{ $doctor->LastName }}
                    </h5>
                </div>
                <div class="card-body d-flex flex-column align-items-center">
                    <img src="{{ asset($doctor->image_path) }}" 
                         alt="Doctor Image" 
                         class="img-fluid rounded mb-3">

                    {{-- Optional: Add specialization or short bio --}}
                    <div class="card-text text-center" 
                         style="max-height: 100px; overflow: hidden; text-overflow: ellipsis;">
                        <a href="{{ $doctor->MDLink }}">View Legitimacy</a> <br/>
                        {{ $doctor->AreaOfExpertise ?? '' }}

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
