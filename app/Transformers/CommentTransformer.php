<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Membership\Comment;

class CommentTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Comment $comment)
    {
        return [
            'num' => (int) $comment->id,
            'comment' => (string) $comment->comment,
            'user' => (int) $comment->user_id,
            'userName' => (string) $comment->user->name,
            'type' => (string) $comment->type,
            'typeID' => (int) $comment->type_id,
            'creationDate' => (string) $comment->created_at,
            'lastChange' => (string) $comment->updated_at,
            'deletedDate' => isset($comment->deleted_at) ? (string) $comment->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
      $attributes = [
        'num' => 'id',
        'comment' => 'comment',
        'user' => 'user_id',
        'type' => 'type',
        'typeID' => 'type_id',
        'creationDate' => 'created_at',
        'lastChange' => 'updated_at',
        'deletedDate' => 'deleted_at',
      ];

      return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
      $attributes = [
        'id' => 'num',
        'comment' => 'comment',
        'user_id' => 'user',
        'type' => 'type',
        'type_id' => 'typeID',
        'created_at' => 'creationDate',
        'updated_at' => 'lastChange',
        'deleted_at' => 'deletedDate',
      ];

      return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
