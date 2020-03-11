<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Membership\MembershipYear;

class MembershipYearTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(MembershipYear $membershipYear)
    {
      return [
          'num' => $membershipYear->id,
          'membershipType' => $membershipYear->type,
          'yr' => (string) $membershipYear->year,
          'money' => (int) $membershipYear->payment,
          'active' => $membershipYear->active == 1,
          'details' => $membershipYear->description,
          'createdDate' => (string) $membershipYear->created_at,
          'lastChange' => (string) $membershipYear->updated_at,
          'dateOfDeleted' => isset($membershipYear->deleted_at) ? (string) $membershipYear->deleted_at : null,
      ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'num' => 'id',
            'membershipType' => 'type',
            'yr' => 'year',
            'money' => 'payment',
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
          'type' => 'membershipType',
          'year' => 'yr',
          'payment' => 'money',
          'description' => 'details',
          'active' => 'active',
          'created_at' => 'creationDate',
          'updated_at' => 'lastChange',
          'deleted_at' => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
