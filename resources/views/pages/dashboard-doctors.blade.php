@extends('dashboard')
@section('content')
    <div class="container-fluid p-2 pt-5 vh-100" style="overflow-y: hide;">
        <h1 class="h1 mt-2 p-3">Services</h1>
        <div class="row bg-white p-3 m-2 border rounded-2">
            <div class="col-sm-3">
                <input type="search" class="form-control rounded-5 form-control-sm" name="search-services"
                    id="search-services" placeholder="search...">
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
                <button data-bs-target="#new-service" data-bs-toggle='modal'
                    class="btn btn-transparent text-sm text-white form-control-sm border" style="background: #244F79;">
                    Add Item <i class="fas fa-plus text-white"></i>
            </div>
        </div>
        <div class="row bg-white p-3 m-2 border rounded-2">
            <div class="col-sm-12">
                <div class="row text-sm">
                    <div class="col-sm-2 pl-4">Service</div>
                    <div class="col-sm-2 text-center"></div>
                    <div class="col-sm-1">Action</div>
                    <div class="col-sm-2 pl-5"></div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2">Details</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row bg-white p-3 m-2 border rounded-2">
                    <div class="col-sm-12">
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-6" style="max-height: 500px; overflow: hidden;">
                <div class="row bg-white p-3 m-2 border rounded-2 sub-service-info-container" style="max-height: 500px; overflow-y: auto">
                    <div class="service-loader-container visually-hidden">
                        <div class="sub-service-container-loader"></div>
                        Searching services for: <p class="do-this fw-semibold text-sm"></p>
                    </div>
                    <center>
                        
                        <div class="col-sm-12 service-info-container">
                            <div class="text-center text-muted">
                                <i class="bi bi-info-circle sub-service-card-icon" style="font-size: 2rem;"></i>
                                <p class="mt-2 mb-0 fw-semibold sub-service-card-title">No service selected</p>
                                <small class="sub-service-card-text">Click a service on the left to view its sub-services
                                    and details here.</small>
                            </div>
                        </div>
                    </center>
                </div>
                
            </div>
        </div>
    </div>
@endsection