<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\AgeGroup;

class AgeGroupTest extends TestCase
{

    use WithFaker;

    protected $age_group_id;
    protected $age_group_id2;
    protected $age_group_object;
    protected $age_group_object2;


    protected function setUp() : void
    {
      parent::setUp();

      $this->age_group_id = AgeGroup::all()->random()->id;

      $this->age_group_id2 = AgeGroup::all()->random()->id;

      $this->age_group_object = [
        'notBelow' => $this->faker->numberBetween(1, 10000000),
        'notAbove' => $this->faker->numberBetween(1, 10000000),
        'title' => $this->faker->word(),
        'details' => $this->faker->paragraph(1, true),
      ];

      $this->age_group_object2 = [
        'notBelow' => $this->faker->numberBetween(1, 10000000),
        'notAbove' => $this->faker->numberBetween(1, 10000000),
        'title' => $this->faker->word(),
        'details' => $this->faker->paragraph(1, true),
      ];
    }


    /**
     * @group AgeGroup
     * @group AgeGroupGet
     * @return void
     */
    public function testIndex()
    {
        $response = $this->json('get', 'ageGroups');

        $response->assertStatus(200);
    }

    /**
     * @group AgeGroup
     * @group AgeGroupStore
     * @return void
     */
    public function testStore()
    {
      $response = $this->json('post', 'ageGroups', $this->age_group_object);

      $response->assertStatus(200);
    }

    /**
     * @group AgeGroup
     * @group AgeGroupShow
     * @return void
     */
    public function testShow()
    {
      $response = $this->json('get', 'ageGroups/' . $this->age_group_id);

      $response->assertStatus(200);
    }

    /**
     * @group AgeGroup
     * @group AgeGroupUpdate
     * @return void
     */
    public function testUpdate()
    {
      $response = $this->json('put', 'ageGroups/'. $this->age_group_id, $this->age_group_object2);

      $response->assertStatus(200);
    }

    /**
     * @group AgeGroup
     * @group AgeGroupDestroy
     * @return void
     */
    public function testDestroy()
    {
      $response = $this->json('delete', 'ageGroups/'. $this->age_group_id2);

      $response->assertStatus(200);
    }

    /**
     * @group AgeGroup
     * @group AgeGroupActions
     * @return void
     */
    public function testAction()
    {
      $response = $this->json('get', 'ageGroups/' . $this->age_group_id . '/actions');

      $response->assertStatus(200);
    }
}
