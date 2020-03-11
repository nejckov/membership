<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Post;
use App\Models\Membership\Member;

class MemberTest extends TestCase
{

    use WithFaker;

    protected $member_id;
    protected $member_id2;

    protected $member_object;
    protected $member_object2;

    protected function setUp() : void
    {

      parent::setUp();

      $this->member_id = Member::all()->random()->id;

      $this->member_id2 = Member::all()->random()->id;

      $this->member_object = [
          'firstName' => $this->faker->firstName,
          'lastName' => $this->faker->lastName,
          'address' => $this->faker->address,
          'telephone' => $this->faker->phoneNumber,
          'email' => $this->faker->email,
          'birth' => '1945-1-1',
          'post' => Post::all()->random()->id,
          'sex' => $this->faker->randomElement(['m', 'f']),
      ];

      $this->member_object2 = [
          'firstName' => $this->faker->firstName,
          'lastName' => $this->faker->lastName,
          'address' => $this->faker->address,
          'telephone' => $this->faker->phoneNumber,
          'email' => $this->faker->email,
          'birth' => '1975-1-1',
          'post' => Post::all()->random()->id,
          'sex' => $this->faker->randomElement(['m', 'f']),
      ];

    }
    /**
     * @group Member
     * @group MemberGet
     * @return void
     */
    public function testIndex()
    {
      $response = $this->json('get', '/members');

      $response->assertStatus(200);

    }

    /**
     * @group Member
     * @group MemberStore
     * @return void
     */

    public function testStore()
    {

      $response = $this->json('post', 'members', $this->member_object);

      $response->assertStatus(200);

    }

    /**
     * @group Member
     * @group MemberShow
     * @return void
     */

    public function testShow()
    {
      $response = $this->json('get', 'members/' . $this->member_id);

      $response->assertStatus(200);
    }

    /**
     * @group Member
     * @group MemberUpdate
     * @return void
     */

    public function testUpdate()
    {

      $response = $this->json('put', 'members/' . $this->member_id , $this->member_object2);

      $response->assertStatus(200);
    }

    /**
     * @group Member
     * @group MemberDestroy
     * @return void
     */

    public function testDestroy()
    {

      $response = $this->json('delete', 'members/'. $this->member_id2);

      $response->assertStatus(200);

    }

    /**
     * @group Member
     * @group MemberAction
     * @return void
     */

    public function testActions()
    {
      $response = $this->json('get', 'members/' . $this->member_id . '/actions');

      $response->assertStatus(200);
    }
}
