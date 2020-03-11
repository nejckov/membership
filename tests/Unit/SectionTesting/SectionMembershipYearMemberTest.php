<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Section;
use App\Models\Membership\MembershipYear;

class SectionMembershipYearMemberTest extends TestCase
{
    /**
     * @group Section
     * @group SectionMembershipYearMember
     * @return void
     */
    public function testIndex()
    {
      $section_id = Section::all()->random()->id;
      $membership_year_id = MembershipYear::all()->random()->id;

      $response = $this->json('get', 'sections/' . $section_id . '/membershipYears/' . $membership_year_id . '/members');

      $response->assertStatus(200);
    }
}
