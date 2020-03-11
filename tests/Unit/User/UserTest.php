<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use App\Models\Membership\Role;
use App\Models\Membership\Company;

class UserTest extends TestCase
{

    protected $user;
    protected $user_object;
    protected $user_object2;
    protected $user_id;
    use WithFaker;


    protected function setUp() : void
    {

      parent::setUp();

      $this->user = User::all()->random();

      $this->user_object = [
        'username' => $this->faker->username,
        'email' => $this->faker->email,
        'password' => 'password',
        'company' => Company::all()->random()->id,
        'role' => Role::all()->random()->id,
      ];

      $this->user_object2 = [
        'username' => $this->faker->username,
        'email' => $this->faker->email,
        'password' => 'password',
        'company' => Company::all()->random()->id,
        'role' => Role::all()->random()->id,
      ];

      $this->user_id = User::all()->random()->id;

      $this->user_id2 = User::all()->random()->id;

    }

    /**
     * @group User
     * @group UserGet
     * @return void
     */
    public function testIndex()
    {
      $response = $this->json('get', 'users');

      $response->assertStatus(200);
    }


    /**
    * @group User
    * @group UserStore
    * @return void
    */
    public function testStore()
    {

      $response = $this->json('post', 'users', $this->user_object);

      $response->assertStatus(200);
    }

    /**
    * @group User
    * @group UserShow
    * @return void
    */
    public function testShow()
    {
      $response = $this->json('get', 'users/' . $this->user_id);

      $response->assertStatus(200);
    }

    /**
    * @group User
    * @group UserUpdate
    * @return void
    */
    public function testUpdate()
    {
      $response = $this->json('put', 'users/' . $this->user_id, $this->user_object2);

      $response->assertStatus(200);
    }

    /**
    * @group User
    * @group UserDelete
    * @return void
    */
    public function testDelete()
    {
      $response = $this->json('delete', 'users/' . $this->user_id2);

      $response->assertStatus(200);
    }

    /**
    * @group User
    * @group UserCurrent
    * @return void
    */
    public function testCurrentUser()
    {
      $response = $this->actingAs($this->user)
                      ->json('get', 'currentUser');

      $response->assertStatus(200);

    }

    /**
    * @group User
    * @group UserActive
    * @return void
    */
    public function testActions()
    {
      $response = $this->json('get', 'users/' . $this->user_id . '/actions');

      $response->assertStatus(200);
    }
}
