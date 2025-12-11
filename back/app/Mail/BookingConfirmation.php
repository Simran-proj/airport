<?php

namespace App\Mail;

use App\Models\Reserva;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @param Reserva $reserva
     * @return void
     */
    public function __construct(Reserva $reserva)
    {
        $this->reserva = $reserva;
        $this->subject = "Booking Confirmation #{$reserva->numero_reserva} - Heathrow Air Park";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.booking-confirmation')
                    ->with([
                        'reserva' => $this->reserva
                    ]);
    }
}