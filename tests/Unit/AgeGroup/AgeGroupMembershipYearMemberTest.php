<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\MembershipYear;
use App\Models\Membership\AgeGroup;

class AgeGroupMembershipYearMemberTest extends TestCase
{
    /**
      * @group AgeGroupF
     * @group AgeGroupMembershipYearMemberIndex
     * @return void
     */
    public function testIndex()
    {
      $age_group_id = AgeGroup::all()->random()->id;

      $membership_year_id = MembershipYear::all()->random()->id;

      $response = $this->json('get', 'ageGroups/' . $age_group_id . '/membershipYears/' . $membership_year_id . '/members');

      $response->assertStatus(200);
    }
}
