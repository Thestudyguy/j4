<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Follow Up Checkup</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #e2e2e2; border-radius: 8px; background: #f9f9f9; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { color: #0d6efd; }
        .section { margin-bottom: 15px; }
        .section h4 { margin-bottom: 5px; color: #0d6efd; }
        .footer { margin-top: 20px; text-align: center; font-size: 0.9rem; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Follow Up Checkup Reminder</h2>
        </div>

        <div class="section">
            <h4>Patient:</h4>
            <p>{{ $appointment->patient_firstname }} {{ $appointment->patient_lastname }}</p>
            <p>Email: {{ $appointment->patient_email ?? 'N/A' }}</p>
            <p>Mobile: {{ $appointment->patient_mobile ?? 'N/A' }}</p>
        </div>

        <div class="section">
            <h4>Dentist:</h4>
            <p>{{ $appointment->doctor_title }} {{ $appointment->doctor_firstname }} {{ $appointment->doctor_lastname }}</p>
            <p>Email: {{ $appointment->doctor_email ?? 'N/A' }}</p>
        </div>

        <div class="section">
            <h4>Appointment Details:</h4>
            <p><strong>Date:</strong> {{ $appointment->appointment_date }}</p>
            <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</p>
            <p><strong>Note ID:</strong> {{ $note_id }}</p>
        </div>

        <div class="footer">
            <p>Thank you for choosing our clinic. Please follow the instructions provided by your dentist.</p>
        </div>
    </div>
</body>
</html>
