<?php

namespace App\Mail;

use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;

    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'You have been invited to the URL Shortener');
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.invitation',
            with: [
                'link' => $this->invitation->acceptUrl(),
                'companyName' => $this->invitation->company->name ?? null,
                'roleLabel' => $this->invitation->role === 'admin' ? 'Admin' : 'Member',
            ],
        );
    }
}
