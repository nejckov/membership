<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Member;
use App\Models\Membership\MembershipYear;

class MemberMembershipYearSectionTets extends TestCase
{
    /**
    * @group Member 
    * @group MemberMembershipYearSection
    * @return void
    */
    public function testIndex()
    {
      $member_id = Member::all()->random()->id;
      $membership_year_id = MembershipYear::all()->random()->id;

      $response = $this->json('get', 'members/' . $member_id . '/membershipYears//' . $membership_year_id . '/sections');

      $response->assertStatus(200);
    }
}
