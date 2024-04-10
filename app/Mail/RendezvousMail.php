<?php

// app/Mail/RendezvousMail.php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class RendezvousMail extends Mailable
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Nouveau Rendez-vous')->view('emails.rendezvous');
    }
}

