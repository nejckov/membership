<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Membership\Role;

class RoleTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Role $role)
    {
      return [
          'num' => (int) $role->id,
          'title' => (string) $role->name,
          'details' => (string) $role->description,
          'createdDate' => (string) $role->created_at,
          'lastChange' => (string) $role->updated_at,
          'dateOfDeleted' => isset($role->deleted_at) ? (string) $role->deleted_at : null,
      ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'num' => 'id',
            'title' => 'name',
            'detail' => 'description',
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
          'description' => 'detail',
          'created_at' => 'creationDate',
          'updated_at' => 'lastChange',
          'deleted_at' => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
