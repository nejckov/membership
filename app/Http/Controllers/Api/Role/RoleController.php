<?php

namespace App\Http\Controllers\Api\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Role;

class RoleController extends ApiController
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
    public function index()
    {
        $roles = Role::all();

        return $this->showCollection($roles);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return $this->showItem($role);
    }


}
