<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use App\Models\Membership\MembershipYear;

class UserMembershipYearMemberTest extends TestCase
{
    /**
    * @group User
    * @group UserMembershipYearMember
    * @return void
    */
    public function testExample()
    {
        $user_id = User::all()->random()->id;
        $membership_year_id = MembershipYear::all()->random()->id;

        $response = $this->json('get', 'users/' . $user_id . '/membershipYears/' . $membership_year_id . '/members');

        $this->assertTrue(true);
    }
}
