<?php

namespace App\Http\Controllers\Api\Doc;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Doc;

class DocSectionController extends ApiController
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
    public function index(Doc $doc)
    {
        $section = $doc->memberships()
                        ->with('sections')
                        ->get()
                        ->pluck('sections')
                        ->collapse()
                        ->values();

        return $this->showCollection($section);
    }


}
