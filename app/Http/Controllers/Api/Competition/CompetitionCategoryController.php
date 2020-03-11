<?php

namespace App\Http\Controllers\Api\Competition;

use Illuminate\Http\Request;

use App\Models\Membership\Competition;

use App\Http\Controllers\ApiController;

class CompetitionCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Competition $competition)
    {
        $categories = $competition->categories;

        return $this->showCollection($categories);
    }

}
