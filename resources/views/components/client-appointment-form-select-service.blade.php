<div class="">
    <p class="client-info fw-bold">Select service</p>
    <div class="row">
        @foreach ($subServices as $service)
        <div class="col-sm-3 mb-4 is-dom-card-selected" id="selected-sub-service-id-{{ $service->id }}">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">{{ $service->Service }}</h5>
                <span class="text-muted">${{ number_format($service->Price, 2) }}</span>
            </div>

                <div class="card-body d-flex flex-column align-items-center">
                    <img src="{{ asset('storage/' . $service->image_path) }}" 
                         width="200" height="200" 
                         alt="service image" 
                         class="img-fluid rounded mb-3">

                    <div class="card-text text-center" 
                         style="max-height: 100px; overflow: hidden; text-overflow: ellipsis;">
                        {{ $service->Description }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
