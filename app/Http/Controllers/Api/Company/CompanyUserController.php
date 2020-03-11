<?php

namespace App\Http\Controllers\Api\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Company;

class CompanyUserController extends ApiController
{

    public function __construct()
    {
      parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
      $users = $company->users;

      return $this->showCollection($users);
    }
}
