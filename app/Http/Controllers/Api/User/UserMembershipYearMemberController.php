<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\User;

class UserMembershipYearMemberController extends ApiController
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
    public function index(User $user)
    {
        $members = $user->memberships()
                          ->get();

        return $this->showCollection($members);
    }

}
