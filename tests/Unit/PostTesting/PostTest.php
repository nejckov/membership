<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Post;

class PostTest extends TestCase
{

  use WithFaker;

  protected $post_id;
  protected $post_object;

    public function setUp() : void
    {

      parent::setUp();

      $this->post_id = Post::all()->random()->id;

      $this->post_object = [
        'post' => $this->faker->city,
      ];

    }



    /**
    * @group Post
    * @group PostGet
     * @return void
     */
    public function testIndex()
    {
        $response = $this->json('get', 'posts/');

        $response->assertStatus(200);
    }

    /**
    * @group Post
    * @group PostShow
    * @return void
    */
    public function testShow()
    {
      $response = $this->json('get', 'posts/' . $this->post_id);

      $response->assertStatus(200);
    }

    /**
    * @group Post
    * @group PostUpdate
    * @return void
    */
    public function testUpdate()
    {
      $response = $this->json('put', 'posts/' . $this->post_id, $this->post_object);

      $response->assertStatus(200);
    }
}
