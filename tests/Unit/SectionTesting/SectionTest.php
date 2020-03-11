<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Section;

class SectionTest extends TestCase
{

    use WithFaker;

    protected $section_id;
    protected $section_id2;
    protected $section_object;
    protected $section_object2;

    protected function setUp() : void
    {

      parent::setUp();

      $this->section_id = Section::all()->random()->id;
      $this->section_id2 = Section::all()->random()->id;

      $this->section_object = [
          'title' => $this->faker->word(),
          'details' => $this->faker->paragraph(3, true),
      ];

      $this->section_object2 = [
          'title' => $this->faker->word(),
          'details' => $this->faker->paragraph(3, true),
      ];

    }
    /**
     * @group Section
     * @group SectionGet
     * @return void
     */
    public function testIndex()
    {
        $response = $this->json('get', 'sections');

        $response->assertStatus(200);
    }

    /**
    * @group Section
    * @group SectionStore
    * @return void
    */

    public function testStore()
    {
      $response = $this->json('post', 'sections', $this->section_object);

      $response->assertStatus(200);
    }

    /**
    * @group Section
    * @group SectionShow
    * @return void
    */

    public function testShow()
    {
      $response = $this->json('get', 'sections/' . $this->section_id);

      $response->assertStatus(200);
    }

    /**
    * @group Section
    * @group SectionUpdate
    * @return void
    */

    public function testUpdate()
    {
      $response = $this->json('put', 'sections/' . $this->section_id, $this->section_object2);

      $response->assertStatus(200);
    }

    /**
    * @group Section
    * @group SectionDestroy
    * @return void
    */

    public function testDestroy()
    {
      $response = $this->json('delete', 'sections/' . $this->section_id2);

      $response->assertStatus(200);
    }

    /**
    * @group Section
    * @group SectionActions
    * @return void
    */

    public function testActions()
    {
      $response = $this->json('get', 'sections/' . $this->section_id2 . '/actions');

      $response->assertStatus(200);
    }
}
