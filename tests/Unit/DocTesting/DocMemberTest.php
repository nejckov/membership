<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Doc;

class DocMemberTest extends TestCase
{
    /**
     * @group Doc
     * @group DocMember
     * @return void
     */
    public function testIndex()
    {
        $doc_id = Doc::all()->random()->id;

        $response = $this->json('get', 'docs/' . $doc_id . '/members');

        $response->assertStatus(200);

    }
}
