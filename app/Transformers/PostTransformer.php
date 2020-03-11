<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Membership\Post;

class PostTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Post $post)
    {
      return [
          'num' => (string) $post->id,
          'post' => (string) $post->name,
          'createdDate' => (string) $post->created_at,
          'lastChange' => (string) $post->updated_at,
          'dateOfDeleted' => isset($post->deleted_at) ? (string) $post->deleted_at : null,
      ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'num' => 'id',
            'post' => 'name',
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
          'name' => 'post',
          'created_at' => 'creationDate',
          'updated_at' => 'lastChange',
          'deleted_at' => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
