<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GeneralEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectLine;
    public $bodyContent;
    protected $pdfData;
    protected $pdfFileName;

    public function __construct($subjectLine, $bodyContent, $pdfData = null, $pdfFileName = null)
    {
        $this->subjectLine = $subjectLine;
        $this->bodyContent = $bodyContent;
        $this->pdfData = $pdfData;
        $this->pdfFileName = $pdfFileName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectLine,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.general',
            with: [
                'subject' => $this->subjectLine,
                'bodyContent' => $this->bodyContent,
            ]
        );
    }

    public function attachments(): array
    {
        if ($this->pdfData && $this->pdfFileName) {
            return [
                \Illuminate\Mail\Mailables\Attachment::fromData(
                    fn () => $this->pdfData,
                    $this->pdfFileName,
                )->withMime('application/pdf'),
            ];
        }
        return [];
    }
}
