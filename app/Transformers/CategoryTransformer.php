<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Membership\Category;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'num' => (int) $category->id,
            'title' => (string) $category->name,
            'above' => (string) $category->from,
            'below' => (string) $category->to,
            'type' => (string) $category->type,
            'typeID' => (int) $category->type_id,
            'peopleSum' => (int) $category->participants,
            'creationDate' => (string) $category->created_at,
            'lastChange' => (string) $category->updated_at,
            'deletedDate' => isset($category->deleted_at) ? (string) $category->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
      $attributes = [
        'num' => 'id',
        'title' => 'name',
        'above' => 'from',
        'below' => 'to',
        'type' => 'type',
        'typeID' => 'type_id',
        'peopleSum' => 'participants',
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
        'from' => 'above',
        'to' => 'below',
        'type' => 'type',
        'type_id' => 'typeID',
        'participants' => 'peopleSum',
        'created_at' => 'creationDate',
        'updated_at' => 'lastChange',
        'deleted_at' => 'deletedDate',
      ];

      return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
