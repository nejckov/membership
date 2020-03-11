<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Membership\Company;

class CompanyTest extends TestCase
{

    use WithFaker;

    protected $company_id;
    protected $company_id2;
    protected $company_object;
    protected $company_object2;

    protected function setUp() : Void
    {

      parent::setUp();

      $this->company_id = Company::all()->random()->id;

      $this->company_id2 = Company::all()->random()->id;

      $this->company_object = [
        'title' => $this->faker->name,
        'details' => $this->faker->paragraph(2, true),
      ];

      $this->company_object2 = [
        'title' => $this->faker->name,
        'details' => $this->faker->paragraph(2, true),
      ];
    }

    /**
    * @group Company
    * @group CompanyGet
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->json('get', 'companies');

        $response->assertStatus(200);
    }

    /**
    * @group Company
    * @group CompanyStore
    * @return void
    */

    public function testStore()
    {
      $response = $this->json('post', 'companies', $this->company_object);

      $response->assertStatus(200);
    }

    /**
    * @group Company
    * @group CompanyShow
    * @return void
    */

    public function testShow()
    {
      $response = $this->json('get', 'companies/' . $this->company_id);

      $response->assertStatus(200);
    }

    /**
    * @group Company
    * @group CompanyUpdate
    * @return void
    */

    public function testUpdate()
    {
      $response = $this->json('put', 'companies/' . $this->company_id, $this->company_object2);

      $response->assertStatus(200);
    }

    /**
    * @group Company
    * @group CompanyDestroy
    * @return void
    */

    public function testDestroy()
    {
      $response = $this->json('delete', 'companies/' . $this->company_id2);

      $response->assertStatus(200);
    }
}
