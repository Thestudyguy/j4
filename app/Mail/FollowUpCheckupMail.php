<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FollowUpCheckupMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Follow Up Checkup Reminder',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.follow-up-checkup', // Blade view we'll create
            with: $this->data
        );
    }

    public function attachments(): array
    {
        return [];
    }
}