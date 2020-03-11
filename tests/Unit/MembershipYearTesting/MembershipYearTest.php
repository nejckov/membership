<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\MembershipYear;

class MembershipYearTest extends TestCase
{

    use WithFaker;

    protected $membership_year_id;
    protected $membership_year_id2;
    protected $membership_year_object;
    protected $membership_year_object2;

    protected function setUp() : void
    {

      parent::setUp();

      $this->membership_year_id = MembershipYear::all()->random()->id;

      $this->membership_year_id2 = MembershipYear::all()->random()->id;

      $this->membership_year_object = [
        'membershipType' => $this->faker->word(1),
        'yr' => $this->faker->numberBetween(1960, 2020),
        'money' => $this->faker->numberBetween(5, 20),
      ];

      $this->membership_year_object2 = [
        'membershipType' => $this->faker->word(1),
        'yr' => $this->faker->numberBetween(1960, 2020),
        'money' => $this->faker->numberBetween(5, 20),
      ];

    }

    /**
    * @group MembershipYear
    * @group MembershipYearGet
    * @return void
    */

    public function testIndex()
    {
        $response = $this->json('get', 'membershipYears');

        $response->assertStatus(200);
    }

    /**
    * @group MembershipYear
    * @group MembershipYearStore
    * @return void
    */

    public function testStore()
    {
      $response = $this->json('post', 'membershipYears/', $this->membership_year_object);

      $response->assertStatus(200);
    }

    /**
    * @group MembershipYear
    * @group MembershipYearShow
    * @return void
    */

    public function testShow()
    {
      $response = $this->json('get', 'membershipYears/' . $this->membership_year_id);

      $response->assertStatus(200);
    }

    /**
    * @group MembershipYear
    * @group MembershipYearUpdate
    * @return void
    */

    public function testUpdate()
    {
      $response = $this->json('put', 'membershipYears/' . $this->membership_year_id, $this->membership_year_object2);

      $response->assertStatus(200);
    }

    /**
    * @group MembershipYear
    * @group MembershipYearDestroy
    * @return void
    */

    public function testDestroy()
    {
      $response = $this->json('delete', 'membershipYears/' . $this->membership_year_id2);

      $response->assertStatus(200);
    }

    /**
    * @group MembershipYear
    * @group MembershipYearActions
    * @return void
    */

    public function testActions()
    {
      $response = $this->json('get', 'membershipYears/' . $this->membership_year_id . '/actions');

      $response->assertStatus(200);
    }
}
