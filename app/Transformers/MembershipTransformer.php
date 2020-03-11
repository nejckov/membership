<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Membership\Membership;

class MembershipTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Membership $membership)
    {
        return [
          'num' => $membership->id,
          'member' => $membership->member_id,
          'document' => $membership->doc_id,
          'membershipYear' => (int) $membership->membership_year_id,
          'user' => $membership->user_id,
          'ageGroup' => $membership->age_group_id,
          'createdDate' => (string) $membership->created_at->format('d.m.Y'),
          'lastChange' => (string) $membership->updated_at,
          'dateOfDeleted' => isset($membership->deleted_at) ? (string) $membership->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'num' => 'id',
            'member' => 'member_id',
            'document' => 'doc_id',
            'membershipYear' => 'membership_year_id',
            'user' => 'user_id',
            'ageGroup' => 'age_group_id',
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
          'member_id' => 'member',
          'doc_id' => 'document',
          'membership_year_id' => 'membershipYear',
          'user_id' => 'user',
          'age_group_id' => 'ageGroup',
          'created_at' => 'creationDate',
          'updated_at' => 'lastChange',
          'deleted_at' => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
