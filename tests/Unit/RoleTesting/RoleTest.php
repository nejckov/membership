<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Role;

class RoleTest extends TestCase
{
    /**
     * @group Role
     * @group RoleGet
     * @return void
     */
    public function testIndex()
    {
        $response = $this->json('get', 'roles');

        $response->assertStatus(200);
    }

    /**
    * @group Role
    * @group RoleShow
    * @return void
    */

    public function testShow()
    {

      $role_id = Role::all()->random()->id;

      $response = $this->json('get', 'roles/' . $role_id);

      $response->assertStatus(200);
    }
}
