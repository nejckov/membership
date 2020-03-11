<?php

namespace App\Http\Controllers\Api\Comment;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Comment;

use App\Transformers\CommentTransformer;

class CommentController extends ApiController
{

    public function __construct()
    {
      parent::__construct();

      $this->middleware('transform.input:' . CommentTransformer::class)->only(['store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = Comment::firstOrCreate([
          'comment' => $request['comment'],
          'user_id' => $request['user_id'],
          'type_id' => $request['type_id'],
        ],
        [
          'type' => Comment::TYPE_COMPETITION,
        ]);

        if(!$comment->wasRecentlyCreated)
        {
          return $this->errorResponse('Komentar ste že oddali', 455);
        }

        return $this->showItem($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return $this->showItem($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $comment = Comment::whereId($comment->id)->first();

        $comment->comment = $request['comment'];

        $comment->save();

        return $this->showItem($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return $this->showItem($comment);
    }
}
