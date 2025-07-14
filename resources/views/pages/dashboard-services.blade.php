@extends('dashboard')
@section('content')
    <div class="container-fluid p-2 pt-5 vh-100" style="overflow-y: hide;">
        <h1 class="h1 mt-2 p-3">Services</h1>
        <div class="row bg-white p-3 m-2 border rounded-2">
            <div class="col-sm-3">
                <input type="search" class="form-control rounded-5 form-control-sm" name="search-services" id="search-services" placeholder="search...">
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-2">
                {{-- <select name="filter-services" class="form-control form-control-sm text-sm" id="">
                    <option value="" selected hidden>
                        Filter
                    </option>
                </select> --}}
            </div>
            <div class="col-sm-2">
                <button class="btn btn-transparent border" style="background: #244F79;" title="download">
                    <i class="fas fa-download text-white"></i>
                </button>
                <button data-bs-target="#new-service" data-bs-toggle='modal' class="btn btn-transparent text-sm text-white form-control-sm border" style="background: #244F79;">
                    Add Item <i class="fas fa-plus text-white"></i>
            </div>
        </div>
        <div class="row bg-white p-3 m-2 border rounded-2">
             <div class="col-sm-12">
                <div class="row text-sm">
                    <div class="col-sm-2 pl-4">Service</div>
                    <div class="col-sm-2 text-center"></div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2 pl-5">Action</div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2">Details</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
            <div class="row bg-white p-3 m-2 border rounded-2">
            <div class="col-sm-12">
                @foreach ($services as $service)
                <div class="row p-2 m-2 border services-list rounded-5 services-row-container" id="service_id_{{$service->id}}">
                    <div class="col-sm-4">
                        {{$service->Service}}
                    </div>
                    <div class="col-sm-4">
                        
                    </div>
                    <div class="col-sm-4 pl-2">
                        <button class="btn btn-transparent p-0 ml-3" data-bs-target='#remove-service-{{$service->id}}' data-bs-toggle='modal'><i class="fas fa-trash text-danger text-sm"></i></button>
                        <button class="btn btn-transparent p-0"><i class="fas fa-pen text-success text-sm"></i></button>
                        <button class="btn btn-transparent p-0" data-bs-target='#new-sub-service-{{$service->id}}' data-bs-toggle='modal'><i class="fas fa-plus text-dark text-sm"></i></button>
                    </div>
                </div>
                @include('modals.remove-service-modal')
                @include('modals.new-sub-service-modal')
                    @endforeach
            </div>
        </div>
        </div>
        <div class="col-sm-4">
            <div class="row bg-white p-3 m-2 border rounded-2">
                <div class="service-loader-container visually-hidden">
                    <div class="sub-service-container-loader"></div>
                    Searching services for: <p class="do-this"></p>
                </div>
                <center>
                    <div class="col-sm-8 service-info-container d-flex align-items-center justify-content-center" style="min-height: 250px; background-color: #f8f9fa; border: 1px dashed #ccc; border-radius: 6px;">
                    <div class="text-center text-muted">
                    <i class="bi bi-info-circle" style="font-size: 2rem;"></i>
                    <p class="mt-2 mb-0 fw-semibold">No service selected</p>
                    <small>Click a service on the left to view its sub-services and details here.</small>
                </div>
            </div>
                </center>

        </div>
        </div>
        </div>
        @include('modals.new-service-modal')
    </div>
@endsection
