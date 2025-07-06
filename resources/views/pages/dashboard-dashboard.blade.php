@extends('dashboard')
@section('content')
    <div class="container-fluid pt-5">
        <div class="row p-5">
            <div class="col-sm-12">
                <h1 class="fw-bold mt-2">Dashboard</h1>
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-title p-2">Total Patients</div>
                            <div class="card-body"></div>
                            <div class="card-footer p-5 bg-white text-center"><h1>100</h1></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <table class="table table-striped">
                            
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-3">
            </div>
        </div>
    </div>
    @endsection
    
    {{-- <center>
   <iframe src="https://calendar.google.com/calendar/embed?src=en.philippines%23holiday%40group.v.calendar.google.com&ctz=Asia%2FManila" scrolling="no"></iframe>
    <style>
         iframe {
              width: 500px;
              height: 400%;
              border: 0;
         }
    </style>
    </center> --}}