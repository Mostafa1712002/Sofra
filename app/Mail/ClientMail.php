<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $record;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($record)
    {
        $this->record = $record;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown("mails.clientMail",["client"=>$this->record]);



    }
}
