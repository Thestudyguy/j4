<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment Confirmation</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f6f8; padding: 20px; color: #333;">

    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 10px; padding: 35px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">

        <h2 style="color: #2a9d8f; text-align: center; margin-bottom: 10px;">
            Appointment Confirmed
        </h2>

        <p style="text-align: center; font-size: 16px; margin-top: 0;">
            Hello <strong>{{ $firstname }} {{ $lastname }}</strong>,
        </p>

        <p>
            Your appointment has been successfully <strong>booked</strong>. Below are the complete details of your visit:
        </p>

        <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
            <tr>
                <td style="padding: 10px; background-color: #f7f7f7;"><strong>Reference ID:</strong></td>
                <td style="padding: 10px;">#{{ $refID }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; background-color: #f7f7f7;"><strong>Date:</strong></td>
                <td style="padding: 10px;">
                    {{ \Carbon\Carbon::parse($date)->toFormattedDateString() }}
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; background-color: #f7f7f7;"><strong>Time:</strong></td>
                <td style="padding: 10px;">
                    {{ \Carbon\Carbon::parse($time)->format('h:i A') }}
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; background-color: #f7f7f7;"><strong>Doctor:</strong></td>
                <td style="padding: 10px;">{{ $doctorName }}</td>
            </tr>
        </table>

        <p style="margin-top: 25px; line-height: 1.5;">
            Kindly arrive at least 
            <strong>{{ $arrivalTime }} minutes before</strong> your scheduled appointment 
            to allow for preparation and avoid delays.
        </p>



        <p style="margin-top: 40px; opacity: .6; font-size: 13px;">
            This is an automated email from <strong>{{ $clinicName }}</strong>. Please do not reply.
        </p>

        <p style="color: #777; font-size: 13px;">&mdash; The Clinic Team</p>

    </div>

</body>
</html>
