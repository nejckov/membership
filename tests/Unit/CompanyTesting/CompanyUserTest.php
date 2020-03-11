<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Company;

class CompanyUserTest extends TestCase
{
    /**
    * @group Company
    * @group CompanyUser
     *
     * @return void
     */
    public function testIndex()
    {

      $company_id = Company::all()->random()->id;

      $response = $this->json('get', 'companies/' . $company_id . '/users');

      $response->assertStatus(200);
    }
}
