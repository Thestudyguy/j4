<div class="container-fluid story p-5" id="j4-services">
    <div class="row m-5">
        <div class="col-12 mb-5 text-center">
            <h2 class="story-title">Our Dental Services</h2>
        </div>
        <div class="row" style="display: flex; justify-content: center; gap: 20px;">
            @foreach ($subServices as $service)
                <div class="col-sm-3">
                    <div class="card h-100 shadow-sm border-0 is-dom-card-selected"
                        id="selected-sub-service-id-{{ $service->id }}">
                        <img src="{{ asset('storage/' . $service->image_path) }}" class="card-img-top img-fluid rounded-top"
                            alt="Service Image" style="object-fit: cover; height: 200px;">

                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title fw-semibold text-primary">{{ $service->Service }}</h5>
                            <p class="card-text text-muted small" style="min-height: 60px;">
                                {{ Str::limit($service->Description, 100) }}
                            </p>
                            <div class="mt-auto">
                                <span class="badge text-dark px-3 py-2">
                                    ₱{{ number_format($service->Price, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <center><h4 class="text-dark text-md fw-semibold mt-3">View all services</h4></center>
    </div>
</div>