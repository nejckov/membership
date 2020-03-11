<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Membership;

class MembershipTest extends TestCase
{
    /**
    * @group Membership
    * @group MembershipGet
    *
    * @return void
    */
    public function testIndex()
    {
        $response = $this->json('get', 'memberships');

        $response->assertStatus(200);
    }

    /**
    * @group Membership
    * @group MembershipShow
    * @return void
    */
    public function testShow()
    {
      $membership_id = Membership::all()->random()->id;

      $response = $this->json('get', 'memberships/' . $membership_id);

      $response->assertStatus(200);
    }
}
