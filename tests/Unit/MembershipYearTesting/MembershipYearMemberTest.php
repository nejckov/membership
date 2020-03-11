<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\MembershipYear;

class MembershipYearMemberTest extends TestCase
{
    /**
     * @group MembershipYear
     * @group MembershipYearMember
     * @return void
     */
    public function testIndex()
    {
        $membership_year_id = MembershipYear::all()->random()->id;

        $response = $this->json('get', 'membershipYears/' . $membership_year_id . '/members');

        $response->assertStatus(200);
    }
}
