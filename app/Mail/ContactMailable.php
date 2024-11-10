<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\attachment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;



class ContactMailable extends Mailable implements ShouldQueue
{

    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address($this->data['email'], $this->data['name']),
            subject: 'Brito academy'
        );
    }



    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact',
            with: [
                'data' => $this->data,
            ],
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array
     */


    public function attachments(): array
    {
        $attachments = [];

        // if (isset($this->data['file'])) {
        //     $attachments[] = Attachment::fromStorage( $this->data['file']);
        // }


    if (isset($this->data['file'])) {
        $attachments[] = Attachment::fromStorage($this->data['file'])
            ->as(basename($this->data['file'])) // Esto establece el nombre del archivo en el email
            ->withMime($this->data['file']->getMimeType()); // Esto define el tipo MIME del archivo
    }


        return $attachments;
        }

}
