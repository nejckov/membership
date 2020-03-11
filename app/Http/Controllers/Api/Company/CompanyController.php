<?php

namespace App\Http\Controllers\Api\Company;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Company;

use App\Transformers\CompanyTransformer;

use App\Events\getActivationActionEvent;

class CompanyController extends ApiController
{

    public function __construct()
    {
      parent::__construct();

      $this->middleware('transform.input:' . CompanyTransformer::class)->only(['store', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();

        return $this->showCollection($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = Company::create([
          'name' => $request['name'],
          'description' => $request['description']
        ]);

        return $this->showItem($company);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return $this->showItem($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $company = Company::whereId($company->id)->first();

        $company->name = $request['name'];
        $company->description = $request['description'];

        $company->save();

        return $this->showItem($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if($company->users())
        {
          return $this->errorResponse('Društvo že obstaja na uporabniku', 453);
        }

        $company->delete();

        return $this->showItem($company);
    }


        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function actions($id)
        {
          $company = Company::whereId($id)->first();

          $active = event(new getActivationActionEvent($company));

          $company->active = $active[0];

          $company->save();

          return $this->showItem($company);

        }
}
