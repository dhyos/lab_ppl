<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking; // Variabel untuk menampung data booking

    // Constructor menerima data booking
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    // Mengatur Subject Email
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Status Pengajuan Lab - ' . ucfirst($this->booking->status),
        );
    }

    // Mengatur View (Isi surat)
    public function content(): Content
    {
        return new Content(
            view: 'emails.booking_status', // Kita akan buat file ini di langkah selanjutnya
        );
    }

    public function attachments(): array
    {
        return [];
    }
}