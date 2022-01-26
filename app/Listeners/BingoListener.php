<?php

namespace App\Listeners;

use App\Events\BingoEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BingoListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(BingoEvent $event)
    {
        \Illuminate\Support\Facades\Mail::to(['ololo@mail.ru', 'ytyyt@hh.com'])
            ->cc('hghghhg.rr@ui.ui')
            ->send(new \App\Mail\BingoMail(1000));
    }
}
