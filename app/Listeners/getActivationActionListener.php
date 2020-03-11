<?php

namespace App\Listeners;

use App\Events\getActivationActionEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class getActivationActionListener
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
     * @param  getActivationActionEvent  $event
     * @return void
     */
    public function handle(getActivationActionEvent $event)
    {

        if($event->active == 0)
        {
          return 1;
        } elseif($event->active == 1) {
          return 0;
        }
    }
}
