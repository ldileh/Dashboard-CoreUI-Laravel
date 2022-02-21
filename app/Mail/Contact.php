<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * variable data send email.
     * that contain attributes :
     * 1. Sender name ['name']
     * 2. Sender email ['emal']
     * 3. Message ['msg']
     */
    public $data = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Hubungi Kami - KPAM Company Profile App')->from($this->data['email'])->view('site.email.contact')->with($this->data);
    }
}
