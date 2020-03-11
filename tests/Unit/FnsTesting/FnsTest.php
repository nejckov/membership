<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Fns;

class FnsTest extends TestCase
{

  use WithFaker;

  protected $fns_id;
  protected $fns_id2;

  protected $fns_object;
  protected $fns_object2;

  protected function setUp() : void
  {
    parent::setUp();

    $this->fns_id = Fns::all()->random()->id;
    $this->fns_id2 = Fns::all()->random()->id;

    $this->fns_object = [
      'title' => $this->faker->name,
      'details' => $this->faker->paragraph(2, true),
    ];

    $this->fns_object2 = [
      'title' => $this->faker->name,
      'details' => $this->faker->paragraph(3, true),
    ];
  }

    /**
     * @group Fns
     * @group FnsGet
     * @return void
     */
    public function testIndex()
    {

      $response = $this->json('get', 'fns');

      $response->assertStatus(200);

    }

    /**
    * @group Fns
    * @group FnsStore
    * @return void
    */
    public function testStore()
    {
      $response = $this->json('post', 'fns', $this->fns_object);

      $response->assertStatus(200);
    }

    /**
    * @group Fns
    * @group FnsShow
    * @return void
    */
    public function testShow()
    {

      $response = $this->json('get', 'fns/' . $this->fns_id);

      $response->assertStatus(200);

    }

    /**
    * @group Fns
    * @group FnsUpdate
    * @return void
    */
    public function testUpdate()
    {
      $response = $this->json('put', 'fns/' . $this->fns_id, $this->fns_object);

      $response->assertStatus(200);
    }

    /**
    * @group Fns
    * @group FnsDelete
    * @return void
    */
    public function testDelete()
    {
        $response = $this->json('delete', 'fns/' . $this->fns_id2);

        $response->assertStatus(200);
    }

    /**
    * @group Fns
    * @group FnsActions
    * @return void
    */
    public function testActions()
    {
      $response = $this->json('get', 'fns/' . $this->fns_id . '/actions');

      $response->assertStatus(200);
    }
}
