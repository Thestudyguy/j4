<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailAppointmentToPatient extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Appointment Confirmation'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.MailPatientAppointmentDetails',
            with: [
                'firstname'     => $this->details['firstname'],
                'lastname'      => $this->details['lastname'],
                'refID'         => $this->details['refID'],
                'doctorName'    => $this->details['doctorName'],
                'date'          => $this->details['date'],
                'time'          => $this->details['time'],
                'status'        => $this->details['status'],
                'clinicName'    => $this->details['clinicName'],
                'clinicContact' => $this->details['clinicContact'],
                'arrivalTime'   => $this->details['arrivalTime'],
                'portalUrl'     => $this->details['portalUrl'],
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
