<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\UserRequest;

use App\User;

use App\Transformers\UserTransformer;

use App\Events\getActivationActionEvent;

class UserController extends ApiController
{
    public function __construct()
    {
      parent::__construct();

      $this->middleware('transform.input:' . UserTransformer::class)->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::all();

      return $this->showCollection($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(UserRequest $request)
    {
      //dd($request->input('user.email'));

        $user = User::firstOrCreate([
          'name' => $request['name'],
          'email' => $request['email'],
        ],
        [
          'password' => $request['password'],
          'role_id' => $request['role_id'],
          'company_id' => 1 // $request['company_id'],
        ]);

        if(!$user->wasRecentlyCreated)
        {
          return $this->errorResponse("Uporabnik že obstaja", 453);
        }

        return $this->showItem($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
      return $this->showItem($user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = User::whereId($user->id)->first();

        $user->name = $request['name'];
        $user->role_id = $request['role_id'];
        $user->company_id = $request['company_id'];

        $user->save();

        return $this->showItem($user);
    }
    /**
    * Get login user resource from storage.
    *
    * @param \App\User $user
    * @return \Illuminate\Http\Response
    */

    public function currentUser(Request $request)
    {
      $user = User::where('email', $request['email'])->first();

      return $this->showItem($user);
    }

    /**
    * Activate or deactivate resource from storage.
    *
    * @param \App\User $user
    * @return \Illuminate\Http\Response
    */

    public function actions($id)
    {
      $user = User::whereId($id)->first();

      $active = event(new getActivationActionEvent($user));

      $user->active = $active[0];

      $user->save();

      return $this->showItem($user);
    }
}
