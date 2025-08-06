<?php

namespace App\Mail;

use App\Models\Pengaduan; // <-- Import model Pengaduan
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifikasiPengaduanBaru extends Mailable
{
    use Queueable, SerializesModels;

    public $pengaduan; // Properti untuk menyimpan data pengaduan

    /**
     * Create a new message instance.
     */
    public function __construct(Pengaduan $pengaduan)
    {
        $this->pengaduan = $pengaduan; // Menerima data saat Mailable dipanggil
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Laporan Pengaduan Baru Diterima', // Judul Email
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Menunjuk ke file view markdown yang sudah dibuat
        return new Content(
            view: 'emails.pengaduan.baru',
        );
    }
}
