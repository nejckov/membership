<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Membership\Section;

class SectionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Section $section)
    {
      return [
          'num' => (int) $section->id,
          'title' => (string) $section->name,
          'details' => (string) $section->description,
          'active' => ($section->active === 1),
          'createdDate' => (string) $section->created_at,
          'lastChange' => (string) $section->updated_at,
          'dateOfDeleted' => isset($section->deleted_at) ? (string) $section->deleted_at : null,
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
