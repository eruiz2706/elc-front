<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SuccessfulLogin
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
      $event->user->fecha_ultimo_ingreso = date('Y-m-d H:i:s');
      $event->user->fecha_ultimo_uso = date('Y-m-d H:i:s');
      $event->user->save();
    }
}
