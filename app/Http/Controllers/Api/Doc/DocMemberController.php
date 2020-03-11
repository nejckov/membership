<?php

namespace App\Http\Controllers\Api\Doc;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Doc;
use App\Models\Membership\Membership;

class DocMemberController extends ApiController
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
        $member = $doc->memberships()
                        ->with('member')
                        ->get()
                        ->pluck('member')
                        ->unique()
                        ->values();

        return $this->showCollection($member);
    }


    public function destroy($doc_id, $member_id)
    {
      $memberships = Membership::where('doc_id', $doc_id)
                                ->where('member_id', $member_id)
                                ->get();

      foreach($memberships as $membership)
      {
        $membership->delete();
      }

      return response()->json([
        'data' => $memberships
      ]);
    }

}
