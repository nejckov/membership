<?php

namespace App\Http\Controllers\Api\Post;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Post;

use App\Transformers\PostTransformer;

class PostController extends ApiController
{
    public function __construct()
    {
      parent::__construct();

      $this->middleware('transform.input:' . PostTransformer::class)->only(['update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return $this->showCollection($posts);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      return $this->showItem($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
      $post = Post::whereId($post->id)->first();

      $post->name = $request['name'];

      $post->save();

      return $this->showItem($post);
    }

}
