<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment Update</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f6f8; padding: 20px; color: #333;">

    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <h2 style="color: #2a9d8f; text-align: center;">
            Hello {{ $details['fname'] }} {{ $details['lname'] }},
        </h2>

        <p>Your appointment has been <strong>updated</strong>. Please review the updated details below:</p>

        <table style="width: 100%; margin-top: 20px; margin-bottom: 20px; border-collapse: collapse;">
            <tr>
                <td style="padding: 10px; background-color: #f1f1f1;"><strong>Date:</strong></td>
                <td style="padding: 10px;">{{ \Carbon\Carbon::parse($details['date'])->toFormattedDateString() }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; background-color: #f1f1f1;"><strong>Time:</strong></td>
                <td style="padding: 10px;">{{ \Carbon\Carbon::parse($details['time'])->format('h:i A') }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; background-color: #f1f1f1;"><strong>Service:</strong></td>
                <td style="padding: 10px;">{{ $details['service'] }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; background-color: #f1f1f1;"><strong>Status:</strong></td>
                <td style="padding: 10px; color: #e76f51;"><strong>{{ ucfirst($details['appointment_update']) }}</strong></td>
            </tr>
        </table>

        <p><strong>Please be on time</strong> for your appointment. If you need to cancel or reschedule, kindly contact us as soon as possible.</p>

        <!-- <div style="margin-top: 30px; text-align: center;">
            <a href="{{ url('/patient/appointments') }}" style="display: inline-block; background-color: #2a9d8f; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px;">View My Appointments</a>
        </div> -->

        <p style="margin-top: 40px; opacity: .6;">This is an automated email. Please do not reply to this message.</p>

        <p style="color: #999;">&mdash; The Clinic Team</p>
    </div>

</body>
</html>
