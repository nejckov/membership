<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Post;
use App\Models\Membership\MembershipYear;

class PostMembershipYearMemberTest extends TestCase
{
    /**
     * @group Post
     * @group PostMembershipYearMember
     * @return void
     */
    public function testIndex()
    {

      $post_id = Post::all()->random()->id;
      $membership_year_id = MembershipYear::all()->random()->id;

      $response = $this->json('get', 'posts/' . $post_id . '/membershipYears/' . $membership_year_id . '/members');

      $response->assertStatus(200);

    }
}
