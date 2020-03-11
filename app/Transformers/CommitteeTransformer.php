<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Membership\Committee;

class CommitteeTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Committee $committee)
    {
        return [
            'num' => (int) $committee->id,
            'memberId' => (int) $committee->member_id,
            'firstName' => (string) $committee->member->fname,
            'lastName' => (string) $committee->member->lname,
            'fns' => (string) $committee->fns_id,
            'fnsName' => (string) $committee->fns->name,
            'yr' => (string) $committee->year,
            'details' => (string) $committee->description,
            'cratedDate' => (string) $committee->created_at,
            'lastChange' => (string) $committee->updated_at,
            'dateOfDeleted' => isset($committee->deleted_at) ? (string) $committee->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
      $attributes = [
        'num' => 'id',
        'member' => 'member_id',
        'firstName' => 'fname',
        'lastName' => 'lname',
        'fns' => 'fns_id',
        'fnsName' => 'fns',
        'yr' => 'year',
        'details' => 'description'
      ];

      return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
      $attributes = [
        'id' => 'num',
        'member_id' => 'member',
        'fname' => 'firstName',
        'lname' => 'lastName',
        'fns_id' => 'fns',
        'fns' => 'fnsName',
        'year' => 'yr',
        'description' => 'details'
      ];

      return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
