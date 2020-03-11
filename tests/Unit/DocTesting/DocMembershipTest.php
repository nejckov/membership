<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\MembershipYear;
use App\Models\Membership\Doc;
use App\Models\Membership\Member;
use App\Models\Membership\Membership;
use App\User;

// use Auth;

class DocMembershipTest extends TestCase
{

    use WithFaker;
    /**
     *
     * @group DocMembershipStore
     * @return void
     */
    public function testStore()
    {

      $membership_year_id = MembershipYear::all()->random()->id;
      $doc_id = Doc::all()->random()->id;
      $user_id = User::all()->random()->id; //Auth::id;

      $memberships = [];

        for($i = 0; $i < $this->faker->numberBetween(3, 12); $i++)
        {
          $membership_item = [
            'member' => Member::all()->random()->id,
            'membershipYear' => $membership_year_id,
            'document' => $doc_id,
            'user' => $user_id,
          ];
          array_push($memberships, $membership_item);
          //$memberships[] = $memberships.appends($membership_item);
        }

        //var_dump($memberships);

        foreach($memberships as $membership)
        {
        $response = $this->json('post', 'docs/' . $doc_id . '/memberships', $membership);

        }

        $this->assertTrue(true);
    }

}
