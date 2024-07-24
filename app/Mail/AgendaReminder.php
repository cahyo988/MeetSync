<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AgendaReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $agenda;

    public function __construct($agenda)
    {
        $this->agenda = $agenda;
    }

    public function build()
    {
        return $this->subject('Agenda Reminder MEETSYNC')
            ->from('meetsyncservice@gmail.com', 'MEETSYNC')
            ->view('emails.agenda-reminder');
    }
}
