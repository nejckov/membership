<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Role;

class RoleUserTest extends TestCase
{
    /**
    * @group Role
    * @group RoleUser
   * @return void
   */
    public function testExample()
    {
      $role_id = Role::all()->random()->id;

      $response = $this->json('get', 'roles/' . $role_id . '/users');

      $response->assertStatus(200);
    }
}
