<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = 'Mensaje de auditor tiendas';

    public $data;
    public $respuestasNO;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $respuestasNO)
    {
      $this->data = $data;
      $this->respuestasNO = $respuestasNO;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('correos.mensaje');
    }
}
