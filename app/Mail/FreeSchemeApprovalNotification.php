<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FreeSchemeApprovalNotification extends Mailable
{
    use Queueable, SerializesModels;
     public $print;
    /**
     * Create a new message instance.
     */
    public function __construct($print)
    {
        $this->print = $print;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $stockist = $this->print[0]->FreeScheme->Stockist->stockist ?? null;
        $chemist = $this->print[0]->FreeScheme->Chemist->chemist ?? null;
        
        if(!$stockist){
            return new Envelope(
                subject: 'Free Scheme Approval - '. $chemist,
            );
        }elseif(!$chemist){
            return new Envelope(
                subject: 'Free Scheme Approval - '. $stockist,
            );
        }
        else{
            return new Envelope(
                subject: 'Free Scheme Approval - '. $stockist . ', ' . $chemist,
            );
        }

       
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'free_schemes.approval_mail',
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

//done