<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $data)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('anam@gmail.com', 'Anam Goo'), //cara khusus
            replyTo: [
                new Address('admin-anamgoo@gmail.com', 'Admin Anam Goo'),
            ],
            subject: 'Welcome Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.welcome',
            with: [
                'email' => $this->data['email'],
                'password' => $this->data['password'],
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];

        // return [
        //     // Attachment::fromPath(Storage::url('images/BIobwjHbmjypUsxoOwGXdlgegXopkwuOmvGOSg13.jpg'))
        //     //     ->as('tax.jpg')
        //     //     ->withMime('application/jpg'),
        //     Attachment::fromPath(Storage::url('/images/BIobwjHbmjypUsxoOwGXdlgegXopkwuOmvGOSg13.jpg')),
        // ];

        // return [
        //     Attachment::fromPath(Storage::url('images/BIobwjHbmjypUsxoOwGXdlgegXopkwuOmvGOSg13.jpg'))
        //         ->as('test-email-1.jpg')
        //         ->withMime('image/jpeg'),
        // ];

        // return [
        //     Attachment::fromPath(Storage::url('images/test-email.jpg'))
        //         ->as('test-email-2.jpg')
        //         ->withMime('image/jpeg'),
        // ];
    }
}
