<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
      return [
          'num' => (int) $user->id,
          'username' => (string)$user->name,
          'email' => (string) $user->email,
          'active' => ($user->active == 1) ? true : false,
          'role' => (integer) $user->role->id,
          'roleTitle' => (string) $user->role->name,
          'company' => (string) $user->company->name,
          'isAdmin' => ($user->role_id < 2) ? true : false,
          'createdDate' => (string) $user->created_at->format('d.m.Y'),
          'lastChange' => (string) $user->updated_at,
      ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'num' => 'id',
            'username' => 'name',
            'email' => 'email',
            'active' => 'active',
            'password' => 'password',
            'company' => 'company_id',
            'role' => 'role_id',
            'creationDate' => 'created_at',
            'lastChange' => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'num',
            'name' => 'username',
            'email' => 'email',
            'active' => 'active',
            'company_id' => 'company',
            'isAdmin' => 'isAdmin',
            'role_id' => 'role',
            'password' => 'password',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
