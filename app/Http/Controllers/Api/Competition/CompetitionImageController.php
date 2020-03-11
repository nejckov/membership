<?php

namespace App\Http\Controllers\Api\Competition;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Competition;

class CompetitionImageController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Competition $competition)
    {
        $image = $competition->images;

        return $this->showCollection($image);

    }

}
