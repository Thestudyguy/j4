<div class="container-fluid story p-5" id="j4-doctors">
    <div class="row m-5">
        <div class="col-12 mb-5 text-center">
            <h2 class="story-title">Our Dentists</h2>
        </div>

        <div class="row" style="display: flex; justify-content: center; gap: 20px;">
            @foreach ($doctors as $doctor)
                <div class="col-sm-3">
                    <div class="card h-100 shadow-sm border-0 is-doctor-dom-card-selected"
                        id="selected-doctor-id-{{ $doctor->id }}">
                        <!-- Image -->
                        <img src="{{ asset($doctor->image_path) }}" alt="Doctor Image"
                            class="card-img-top img-fluid rounded-top" style="object-fit: cover; height: 250px;">

                        <div class="card-body d-flex flex-column justify-content-between align-items-center text-center">
                            <a href="{{ Str::startsWith($doctor->MDLink, ['http://', 'https://']) ? $doctor->MDLink : 'https://' . $doctor->MDLink }}"
                                class="text-decoration-none text-primary" target="_blank" rel="noopener">
                                <h5 class="card-title fw-semibold m-0">
                                    {{ $doctor->ProfessionalTitle ?? '' }}
                                    {{ $doctor->FirstName }}
                                    @if($doctor->MiddleName)
                                        {{ $doctor->MiddleName }}
                                    @endif
                                    {{ $doctor->LastName }}
                                    @if($doctor->Suffix)
                                        {{ $doctor->Suffix }}
                                    @endif
                                </h5>
                            </a>

                            <!-- Area of Expertise -->
                            <p class="card-text text-muted small mt-2" style="min-height: 50px;">
                                {{ $doctor->AreaOfExpertise ?? '' }}
                            </p>
                        </div>


                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>