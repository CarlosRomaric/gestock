<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\BonSortie;

class NotificationStatusValidationBon extends Mailable
{
    use Queueable, SerializesModels;

    public $bonSortie;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BonSortie $bonSortie)
    {
        $this->bonSortie = $bonSortie;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.notificationStatusBon');
    }
}
