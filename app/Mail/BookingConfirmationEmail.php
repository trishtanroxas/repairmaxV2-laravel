<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Appointment;

class BookingConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public Appointment $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function envelope(): Envelope
    {
        $refNumber = $this->appointment->booking_number ?: $this->appointment->tracking_code;
        return new Envelope(
            subject: 'Booking Confirmation - Repair Appointment Received [' . $refNumber . ']',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking-confirmation',
            with: [
                'firstName' => $this->appointment->user?->first_name ?? 'Valued Customer',
                'lastName' => $this->appointment->user?->last_name ?? '',
                'trackingCode' => $this->appointment->tracking_code,
                'deviceBrand' => $this->appointment->device_brand,
                'deviceModel' => $this->appointment->device_model,
                'faultCategory' => $this->appointment->fault_category,
                'description' => $this->appointment->description,
                'email' => $this->appointment->user?->email ?? '',
                'appointment' => $this->appointment,
            ]
        );
    }
}
