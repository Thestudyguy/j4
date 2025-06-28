@extends('layouts.app')

@section('hideNavBar')
@endsection

@section('hideFooter')
@endsection
@section('content')
<div class="container my-5 p-4 bg-light rounded shadow-sm">
    <h4 class="mb-4">Dental History</h4>

    <form method="POST">
        @csrf

        <div class="row mb-4">
            <div class="col-md-6">
                <label>Previous Dentist</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Last Dental Visit</label>
                <input type="text" class="form-control">
            </div>
        </div>

        <h4 class="mb-3">Medical History</h4>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Name of Physician</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Specialty (if applicable)</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-6 mt-3">
                <label>Office Address</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-6 mt-3">
                <label>Office Number</label>
                <input type="text" class="form-control">
            </div>
        </div>

  
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Are you in good health?</label><br>
                <input type="checkbox"> Yes
                <input type="checkbox"> No
            </div>
            <div class="col-md-6">
                <label>Do you use alcohol, cocaine or other dangerous drugs?</label><br>
                <input type="checkbox"> Yes
                <input type="checkbox"> No
            </div>
            <div class="col-md-6 mt-3">
                <label>Are you under medical condition now?</label><br>
                <input type="checkbox"> Yes
                <input type="checkbox"> No
                <input type="text" class="form-control mt-1" placeholder="If yes, what is the condition being treated?">
            </div>
            <div class="col-md-6 mt-3">
                <label>Are you allergic to any of the following:</label><br>
                <input type="checkbox"> Lidocaine
                <input type="checkbox"> Aspirin
                <input type="checkbox"> Penicillin
                <input type="checkbox"> Sulfa Drugs
                <input type="checkbox"> Latex
                <input type="checkbox"> Others <input type="text" class="form-control d-inline w-auto" style="width: 150px;">
            </div>
            <div class="col-md-6 mt-3">
                <label>Have you ever had serious illness or surgical operation?</label><br>
                <input type="checkbox"> Yes
                <input type="checkbox"> No
                <input type="text" class="form-control mt-1" placeholder="If yes, what illness or operation?">
            </div>
            <div class="col-md-6 mt-3">
                <label>Have you ever been hospitalized?</label><br>
                <input type="checkbox"> Yes
                <input type="checkbox"> No
                <input type="text" class="form-control mt-1" placeholder="If so, when and why?">
            </div>
            <div class="col-md-6 mt-3">
                <label>Are you taking any medication?</label><br>
                <input type="checkbox"> Yes
                <input type="checkbox"> No
                <input type="text" class="form-control mt-1" placeholder="If so, please specify">
            </div>
            <div class="col-md-6 mt-3">
                <label>Do you use tobacco products?</label><br>
                <input type="checkbox"> Yes
                <input type="checkbox"> No
            </div>

            <div class="col-md-6 mt-3">
                <label>For women only:</label><br>
                <div class="mb-1">
                    Are you pregnant? <input type="checkbox"> Yes <input type="checkbox"> No
                </div>
                <div class="mb-1">
                    Taking birth control pills? <input type="checkbox"> Yes <input type="checkbox"> No
                </div>
                <div class="mb-1">
                    Are you nursing? <input type="checkbox"> Yes <input type="checkbox"> No
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <label>Bleeding time</label>
                <input type="text" class="form-control">
                <label class="mt-2">Blood type</label>
                <input type="text" class="form-control">
                <label class="mt-2">Blood pressure</label>
                <input type="text" class="form-control">
            </div>
        </div>

        <div class="row mt-4">
            <label><strong>Do you have or have you had any of the following? Check which apply.</strong></label>
            <div class="col-md-12">
                @php
                    $conditions = [
                        'High Blood Pressure', 'Low Blood Pressure', 'Epilepsy/Convulsions', 'AIDS or HIV Infection',
                        'Sexually Transmitted Disease', 'Stomach Troubles/Ulcers', 'Fainting Seizure', 'Rapid Weight Loss',
                        'Radiation Therapy', 'Joint Replacement/Implant', 'Heart Surgery', 'Heart Attack', 'Thyroid Problem',
                        'Heart Disease', 'Head Murmur', 'Hepatitis/Liver Disease', 'Rheumatic Fever', 'Hay Fever/Allergies',
                        'Respiratory Problems', 'Hepatitis/Jaundice', 'Tuberculosis', 'Swollen Ankles', 'Kidney Disease',
                        'Diabetes', 'Chest Problems', 'Stroke', 'Cancer/Tumors', 'Anemia', 'Angina', 'Asthma',
                        'Emphysema', 'Bleeding Problems', 'Blood Disease', 'Head Injuries', 'Arthritis/Rheumatism'
                    ];
                @endphp
                <div class="row">
                    @foreach (array_chunk($conditions, 6) as $chunk)
                        <div class="col-md-4">
                            @foreach ($chunk as $condition)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input">
                                    <label class="form-check-label">{{ $condition }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ url('/client-appointment-form.') }}" class="btn btn-secondary">Back</a>
            <a href="{{ url('/signature') }}" class="btn btn-primary">Signature</a>
        </div>
    </form>
</div>
@endsection
