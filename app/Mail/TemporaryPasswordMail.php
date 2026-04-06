<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TemporaryPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $tempPassword;

    public function __construct(
        public User $user,
        string $tempPassword
    ) {
        $this->tempPassword = $tempPassword;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🔐 Password Reset – RBAC System',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.temp-password',
        );
    }
}



