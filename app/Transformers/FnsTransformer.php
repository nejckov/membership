<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Membership\Fns;

class FnsTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Fns $fns)
    {
        return [
            'num' => (int) $fns->id,
            'title' => (string) $fns->name,
            'details' => (string) $fns->description,
            'active' => ($fns->active == 1),
            'creationDate' => (string) $fns->created_at,
            'lastChange' => (string) $fns->updated_at,
            'deletedDate' => isset($fns->deleted_at) ? (string) $fns->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
      $attributes = [
        'num' => 'id',
        'title' => 'name',
        'details' => 'description',
        'active' => 'active',
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
        'active' => 'active',
        'created_at' => 'creationDate',
        'updated_at' => 'lastChange',
        'deleted_at' => 'deletedDate',
      ];

      return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
