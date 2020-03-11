<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Membership\AgeGroup;

class AgeGroupTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
     public function transform(AgeGroup $age_group)
     {
         return [
             'num' => $age_group->id,
             'notBelow' => (string) $age_group->from,
             'notAbove' => (string) $age_group->to,
             'title' => (string) $age_group->name,
             'details' => (string) $age_group->description,
             'active' => ($age_group->active == 1),
             'createdDate' => (string) $age_group->created_at,
             'lastChange' => (string) $age_group->updated_at,
             'dateOfDeleted' => isset($age_group->deleted_at) ? (string) $age_group->deleted_at : null,
         ];
     }

     public static function originalAttribute($index)
     {
         $attributes = [
             'num' => 'id',
             'notBelow' => 'from',
             'notAbove' => 'to',
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
           'from' => 'notBelow',
           'to' => 'notAbove',
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
