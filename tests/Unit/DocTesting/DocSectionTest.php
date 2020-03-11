<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Doc;

class DocSectionTest extends TestCase
{
    /**
     * @group Doc
     * @group DocSection
     * @return void
     */
    public function testIndex()
    {
      $doc_id = Doc::all()->random()->id;

      $response = $this->json('get', 'docs/' . $doc_id . '/sections');

      $response->assertStatus(200);
    }
}
