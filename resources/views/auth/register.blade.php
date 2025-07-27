@extends('layouts.app')

@section('content')
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6">
                <div class="card" style="overflow: hidden;">
                    <div class="card-body">
                        <div class="row">
                            <!-- logo underneath -->
                            <div class="col-sm-12 d-flex justify-content-center">
                                <img src="{{ asset('images/dclogo.png') }}" width="100" alt="">
                            </div>
                            <!-- warning underneath -->
                            <div class="col-sm-12">
                                <p class="fw-bold lead text-center">To book an appointment, create an account</p>
                            </div>
                            <!-- form underneath -->
                            <form action="" class="new-patient p-4"
                                style="max-width: 500px; margin: 0 auto;">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" id="firstName" name="first_name" class="form-control" >
                                </div>

                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" id="lastName" name="last_name" class="form-control" >
                                </div>

                                 <div class="mb-3">
                                    <label for="userName" class="form-label">User Name</label>
                                    <input type="text" id="userName" name="user_name" class="form-control" >
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" id="email" name="email" class="form-control" >
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" >
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" >
                                </div>

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn text-white" style="background-color: #4A7E88;">
                                        Create Account
                                    </button>
                                </div>

                                <div class="text-center">
                                    <small>
                                        Already have an account?
                                        <a href="/login" style="color: #4A7E88;">Log in here</a>
                                    </small>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection