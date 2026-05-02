<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Event $event,
        public User $volunteer,
        public string $emailSubject,  
        public string $body,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->emailSubject);  
    }

    public function content(): Content
    {
        return new Content(view: 'emails.event-reminder');
    }
}