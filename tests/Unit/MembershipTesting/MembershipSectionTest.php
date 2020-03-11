<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Membership;
use App\Models\Membership\Section;

class MembershipSectionTest extends TestCase
{

    protected $membership_id;
    protected $section_id;

    protected function setUp() : void
    {

      parent::setUp();

      $this->membership_id = Membership::all()->random()->id;
      $this->section_id = Section::all()->random()->id;

    }

    /**
    * @group Membership
    * @group MembershipSectionGet
    * @return void
    */

    public function testIndex()
    {

      $response = $this->json('get', 'memberships/' . $this->membership_id . '/sections');

      $response->assertStatus(200);

    }

    /**
     *
     * @group Membership
     * @group MembershipSectionUpdate
     * @return void
     */

    public function testStore()
    {

      $response = $this->json('put', 'memberships/' . $this->membership_id . '/sections/' . $this->section_id);

      $response->assertStatus(200);

    }

    /**
    * @group Membership
    * @group MembershipSectionDelete
    * @return void
    */

    public function testDestroy()
    {
      $response = $this->json('delete', 'memberships/' . $this->membership_id . '/sections/' . $this->section_id);

      $response->assertStatus(200);
    }
}
