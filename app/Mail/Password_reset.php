<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Password_reset extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $contraseña;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($usuario, $contraseña)
    {
        $this->usuario = $usuario;
        $this->contraseña =  $contraseña;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->view('correos.reseteo-contraseña');
    }
}
