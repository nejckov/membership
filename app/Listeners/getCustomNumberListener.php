<?php

namespace App\Listeners;

use App\Events\getCustomNumberEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Membership\Member;

class getCustomNumberListener
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
     * @param  getCustomNumberEvent  $event
     * @return void
     */
    public function handle(getCustomNumberEvent $event)
    {
        $last_member = Member::orderBy('custom_number', 'desc')->first();

        return $last_member->custom_number + 1;
    }
}
