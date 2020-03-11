<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;
use Carbon\Carbon;

use App\Models\Membership\Member;
use App\Models\Membership\Post;
use App\Models\Membership\Membership;

use App\Transformers\MemberTransformer;

use App\Events\getActivationActionEvent;
use App\Events\getCustomNumberEvent;

class MemberController extends ApiController
{

    public function __construct()
    {
      parent::__construct();

      $this->middleware('transform.input:' . MemberTransformer::class)->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();

        return $this->showCollection($members);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        $custom_number = event(new getCustomNumberEvent());

        $member = Member::firstOrCreate([
          'fname' => $request['fname'],
          'lname' => $request['lname'],
          'birthdate' => date('Y-m-d', strtotime($request['birthdate'])),
        ],
        [
          'address' => $request['address'],
          'mobile' => $request['mobile'],
          'email' => $request['email'],
          'post_id' => $request['post_id'],
          'custom_number' => $custom_number[0],
          'gender' => $request['gender'],
          'description' => $request['description'],
        ]);

        if(!$member->wasRecentlyCreated)
        {
          return $this->errorResponse('Ta član že obstaja v sistemu', 453);
        }

        return $this->showItem($member);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return $this->showItem($member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(MemberRequest $request, Member $member)
    {

      $member = Member::whereId($member->id)->first();

      $member->fname = $request['fname'];
      $member->lname = $request['lname'];
      $member->address = $request['address'];
      $member->email = $request['email'];
      $member->mobile = $request['mobile'];
      $member->gender = $request['gender'];
      $member->birthdate = date('Y-m-d', strtotime($request['birthdate']));
      $member->description = $request['description'];

      $member->save();

      return $this->showItem($member);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
      if($member->memberships())
      {
        return $this->errorResponse('Član že obstaja v članstvu', 453);
      }

      $member->delete();

      return $this->showItem($member);
  }

  public function actions($id)
  {
    $member = Member::whereId($id)->first();

    $active = event(new getActivationActionEvent($member));

    $member->active = $active[0];

    $member->save();

    return $this->showItem($member);
  }

}
