<?php

namespace App\Http\Controllers\Api\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Role;

class RoleUserController extends ApiController
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
    public function index(Role $role)
    {

      $users = $role->users()
                      ->get();

      return $this->showCollection($users);
    }

}
