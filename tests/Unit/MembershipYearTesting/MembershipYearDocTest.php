<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\MembershipYear;

class MembershipYearDocTest extends TestCase
{
    /**
     * @group MembershipYear
     * @group MembershipYearDoc
     * @return void
     */
    public function testIndex()
    {
      $membership_year_id = MembershipYear::all()->random()->id;

      $response = $this->json('get', 'membershipYears/' . $membership_year_id .'/docs');

      $response->assertStatus(200);
    }
}
