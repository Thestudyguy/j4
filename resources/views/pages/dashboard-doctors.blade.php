@extends('dashboard')
@section('content')
    <div class="container-fluid p-2 pt-5 vh-100" style="overflow-y: hide;">
        <h1 class="h1 mt-2 p-3">Doctors/Dentists</h1>
        <div class="row bg-white p-3 m-2 border rounded-2">
            <div class="col-sm-3">
                <input type="search" class="form-control rounded-5 form-control-sm" name="search-doctors"
                    id="search-doctors" placeholder="search...">
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-2">
            </div>
            <div class="col-sm-2">
                <button data-bs-target="#new-doctor" data-bs-toggle='modal'
                    class="btn btn-transparent text-sm text-white form-control-sm border" style="background: #244F79;">
                    <i class="fas fa-plus text-white"></i>
            </div>
        </div>
        <div class="row bg-white p-3 m-2 border rounded-2">
            <div class="col-sm-12">
                <div class="row text-sm">
                    <div class="col-sm-2 pl-4">Doctors</div>
                    <div class="col-sm-2 text-center"></div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2 pl-5"></div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row bg-white p-3 m-2 border rounded-2">
                    <div class="col-sm-12">
                        @foreach ($doctors as $doctor)
                            <div class="row p-2 m-2 border doctor-list text-sm rounded-5 doctor-row-container"
                                id="doctor_id_{{$doctor->id}}">
                                <div class="col-sm-4">
                                   {{$doctor->ProfessionalTitle}}. {{$doctor->LastName}}, {{$doctor->FirstName}} {{$doctor->MiddleName}} - {{$doctor->Suffix}}
                                </div>
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-4 pl-2 d-flex align-items-center justify-content-center">
                                    <button class="btn btn-transparent p-0 ml-3"
                                        data-bs-target='' data-bs-toggle='modal'><i
                                            class="fas fa-trash text-danger text-sm"></i></button>
                                    <button class="btn btn-transparent p-0"><i
                                            class="fas fa-pen text-success text-sm"></i></button>
                                    <button class="btn btn-transparent p-0" data-bs-target=''
                                        data-bs-toggle='modal'><i class="fas fa-plus text-dark text-sm"></i></button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @include('modals.new-doctor')
    </div>
@endsection