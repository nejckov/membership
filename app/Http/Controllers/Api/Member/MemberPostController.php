<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Member;

class MemberPostController extends ApiController
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
    public function index(Member $member)
    {
        $post = $member->post;

        return $this->showItem($post);
    }


}
