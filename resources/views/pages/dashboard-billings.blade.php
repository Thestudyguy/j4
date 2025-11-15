@extends('dashboard')
@section('content')
    <div class="container-fluid pt-5">
        <div class="loader-container billings-page visually-hidden">
            <div class="loader"></div>
        </div>
        <div class="row mt-2 p-3">
            <div class="col-sm-10">
                <h1 class="h1 mt-2 p-3">Billings</h1>
            </div>
            <div class="col-sm-2 mt-2 p-3">
                <button class="btn btn-primary lead sm fw-normal" data-bs-target="#new-billing" data-bs-toggle="modal">
                    <i class="fas fa-plus mx-1 fw-normal"></i>New Billing
                </button>
                @include('modals.new-billing-modal')
            </div>
        </div>
        <div class="row mt-2 p-2">
            <div class="col-sm-3">
                <div class="card p-5">
                    <span class=" lead fw-semibold text-muted">Total Billings</span>
                    <div class="card-body">
                        <span class="text-center fw-semibold text-lg">
                            100
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card p-5">
                    <span class="lead fw-semibold text-muted">Total Revenue</span>
                    <div class="card-body">
                        <span class="text-center fw-semibold text-lg">
                            100
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-2">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <input type="text" name="" class="form-control" placeholder="search..." id="">
                    </div>
                    <span class="fw-bold text-lg">Billings</span>
                </div>
                <div class="card-body" style="overflow-y: auto; max-height: 500px;">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <th>Patient</th>
                            <th>Procedure</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Date Issued</th>
                        </thead>
                        <tbody>
                            @foreach ($billings as $item)
                                <tr id="{{ $item->appointmentID }}">
                                    <td>{{ $item->FirstName }} {{ $item->LastName }}</td>
                                    <td>{{ $item->Service }}</td>
                                    <td>{{ $item->itemPrice }}</td>
                                    <td>{{ $item->date }} - {{ $item->time }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <div class="col-sm-4">
                                            <a href="" target="_blank"
                                                class="btn btn-transparent border border-secondary float-end btn-sm fw-semibold text-sm">
                                                <i class="fas fa-upload"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
