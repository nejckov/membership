<?php

namespace App\Http\Controllers\Api\Category;

use Illuminate\Http\Request;
use App\Models\Membership\Category;
use App\Http\Controllers\ApiController;

class CategoryResultController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $results = $category->results;

        return $this->showCollection($results);
    }

}
