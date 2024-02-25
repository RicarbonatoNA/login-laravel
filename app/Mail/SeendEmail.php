<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class SeendEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $url;
    protected $codigo;
    /**
     * Create a new message instance.
     */
    public function __construct(User $user,$codigo,$url)
    {
        $this->user = $user;
        $this->codigo=$codigo;
        $this->url=$url;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'codigo de confirmacion',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'pages.mailPage',
            with:[
                "name"=>$this->user->name,
                "codigo"=>$this->codigo,
                "url"=>$this->url
            ]
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
    }
}
