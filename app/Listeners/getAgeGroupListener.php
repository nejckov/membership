<?php

namespace App\Listeners;

use App\Events\getAgeGroupEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Membership\AgeGroup;

class getAgeGroupListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  getAgeGroupEvent  $event
     * @return void
     */
    public function handle(getAgeGroupEvent $event)
    {

      $age_groups = AgeGroup::all();

      foreach($age_groups as $age_group)
      {
        if($age_group->from <= $event->member_age && $age_group->to >= $event->member_age)
        {
          return $age_group->id;
        }
      }

    }
}
