<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Doc;

class DocMembershipYearTest extends TestCase
{
    /**
     * @group Doc
     * @group DocMembershipYear
     * @return void
     */
    public function testIndex()
    {
      $doc_id = Doc::all()->random()->id;

        $response = $this->json('get', 'docs/' . $doc_id . '/membershipYears');

        $response->assertStatus(200);
    }
}
