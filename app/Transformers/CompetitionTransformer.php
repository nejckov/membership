<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Membership\Competition;

class CompetitionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
     public function transform(Competition $competition)
     {
         return [
             'num' => (int) $competition->id,
             'competition' => (string) $competition->name,
             'date' => $competition->competition_date_eu,
             'time' => (string) $competition->competition_time,
             'city' => (string) $competition->place,
             'payment' => (int) $competition->payment,
             'details' => (string) $competition->description,
             'creationDate' => (string) $competition->created_at,
             'lastChange' => (string) $competition->updated_at,
             'deletedDate' => isset ($competition->deleted_at) ? (string)$competition->deleted_at : null,
         ];
     }

     public static function originalAttribute($index)
     {
         $attributes = [
             'num' => 'id',
             'competition' => 'name',
             'date' => 'competition_date',
             'time' => 'competition_time',
             'city' => 'place',
             'payment' => 'payment',
             'details' => 'description',
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
           'name' => 'competition',
           'competition_date' => 'date',
           'competition_time' => 'time',
           'place' => 'city',
           'payment' => 'payment',
           'description' => 'details',
           'created_at' => 'creationDate',
           'updated_at' => 'lastChange',
           'deleted_at' => 'deletedDate',
         ];

         return isset($attributes[$index]) ? $attributes[$index] : null;
     }
}
