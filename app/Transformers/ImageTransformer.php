<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Membership\Image;

class ImageTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Image $image)
    {
        return [
            'num' => (int) $image->id,
            'title' => (string) $image->name,
            'details' => (string) $image->description,
            'source' => (string) $image->src,
            'user' => (int) $image->user_id,
            'type' => (string) $image->type,
            'typeID' => (int) $image->type_id,
            'creationDate' => (string) $image->created_at,
            'lastChange' => (string) $image->updated_at,
            'deletedDate' => isset($image->deleted_at) ? (string) $image->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
      $attributes = [
        'num' => 'id',
        'title' => 'name',
        'details' => 'description',
        'source' => 'src',
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
        'name' => 'title',
        'description' => 'details',
        'src' => 'source',
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
