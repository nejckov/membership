<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Member;

class MemberPostTest extends TestCase
{
  /**
  * @group Member
  * @group MemberPost
  * @return void
  */
  public function testIndex()
  {
      $member_id = Member::all()->random()->id;

      $response = $this->json('get', 'members/' . $member_id . '/posts');

      $response->assertStatus(200);
  }
}
