<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Doc;

class DocTest extends TestCase
{
    use WithFaker;

    protected $doc_id;
    protected $doc_id2;
    protected $doc_object;
    protected $doc_object2;

    protected function setUp() : Void
    {

      parent::setUp();

      $this->doc_id = Doc::all()->random()->id;

      $this->doc_id2 = Doc::all()->random()->id;

      $this->doc_object = [
          'document' => $this->faker->numberBetween(10000, 1000004),
      ];

      $this->doc_object2 = [
          'document' => $this->faker->numberBetween(10000, 1000004),
      ];

    }


    /**
     * @group Doc
     * @group DocGet
     * @return void
     */
    public function testIndex()
    {
        $response = $this->json('get', 'docs');

        $response->assertStatus(200);
    }

    /**
    * @group Doc
    * @group DocStore
    * @return void
    */
    public function testStore()
    {

      //dd($this->doc_object);

      $response = $this->json('post', 'docs',  $this->doc_object);

      $response->assertStatus(200);
    }

    /**
    * @group Doc
    * @group DocShow
    * @return void
    */
    public function testShow()
    {
      $response = $this->json('get', 'docs/' . $this->doc_id);

      $response->assertStatus(200);
    }

    /**
    * @group Doc
    * @group DocUpdate
    * @return void
    */
    public function testUpdate()
    {
      $response = $this->json('put', 'docs/' . $this->doc_id2, $this->doc_object2);

      $response->assertStatus(200);
    }

    /**
    * @group Doc
    * @group DocDelete
    * @return void
    */

    public function testDestroy()
    {
      $response = $this->json('delete', 'docs/' . $this->doc_id2);

      $response->assertStatus(200);
    }

}
