<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Committee;
use App\Models\Membership\Member;
use App\Models\Membership\MembershipYear;
use App\Models\Membership\Fns;

class CommitteeTest extends TestCase
{

  use WithFaker;

  protected $committee_id;
  protected $commiteee_id2;

  protected $committee_object;
  protected $committee_object2;

  protected function setUp() : void {

    parent::setUp();

    $this->committee_id = Committee::all()->random()->id;
    $this->committee_id2 = Committee::all()->random()->id;

    $this->commitee_object = [
      'member' => Member::all()->random()->id,
      'fns' => Fns::all()->random()->id,
      'yr' => MembershipYear::all()->random()->year,
      'details' => $this->faker->paragraph(3, true),
    ];

    $this->committee_object2 = [
      'member' => Member::all()->random()->id,
      'fns' => Fns::all()->random()->id,
      'yr' => MembershipYear::all()->random()->year,
      'details' => $this->faker->paragraph(3, true),
    ];
  }

    /**
     * @group Committee
     * @group CommitteeGet
     * @return void
     */
    public function testIndex()
    {

      $response = $this->json('get', 'committees');

      $response->assertStatus(200);

    }

    /**
    * @group Committee
    * @group CommitteeStore
    * @return void
    */
    public function testStore()
    {
      $response = $this->json('post', 'committees', $this->commitee_object);

      $response->assertStatus(200);
    }

    /**
    * @group Committee
    * @group CommitteeShow
    * @return void
    */
    public function testShow()
    {
      $response = $this->json('get', 'committees/' . $this->committee_id);

      $response->assertStatus(200);
    }

    /**
    * @group Committee
    * @group CommitteeUpdate
    * @return void
    */
    public function testUpdate()
    {
      $response = $this->json('put', 'committees/' . $this->committee_id, $this->committee_object2);

      $response->assertStatus(200);
    }

    /**
    * @group Committee
    * @group CommitteeDestroy
    * @return void
    */
    public function testDestroy()
    {
      $response = $this->json('delete', 'committees/' . $this->committee_id2);

      $response->assertStatus(200);
    }

}
