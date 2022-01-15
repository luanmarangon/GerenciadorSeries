<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EnviarMailNovaSerie implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param NovaSerie $event
     * @return void
     */
    public function handle(NovaSerie $event)
    {
        $nomeSerie = $event->nomeSerie;
        $qtdTemporadas = $event->qtdTemporadas;
        $epPorTemporada = $event->epPorTemporada;

        $users = User::all();
        foreach ( $users as $m => $user ) {

            $email = new \App\Mail\NovaSerie(
                $nomeSerie,
                $qtdTemporadas,
                $epPorTemporada
            );
            $email->subject = 'Nova Série Adicionada';

//            colocando um tempo no envio de cada email, evitando erro
            Mail::to($user)->later(now()->addSecond(($m + 1) * 5), $email);
//            enviando para a fila
//            Mail::to($user)->queue($email);
//            enviando email na hora
//            Mail::to($user)->send($email);
//            sleep(5);
        }
    }
}
