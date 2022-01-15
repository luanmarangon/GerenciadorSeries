<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovaSerie extends Mailable
{
    use Queueable, SerializesModels;

    public $nomeSerie;
    public $qtdTemporada;
    public $epPorTemporada;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nomeSerie, $qtdTemporada, $epPorTemporada)
    {
        $this->nomeSerie = $nomeSerie;
        $this->qtdTemporada = $qtdTemporada;
        $this->epPorTemporada = $epPorTemporada;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.serie.NovaSerie');
    }
}
