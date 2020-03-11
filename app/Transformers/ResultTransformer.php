<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Membership\Result;

class ResultTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Result $result)
    {
        return [
            'num' => (int) $result->id,
            'place' => (string) $result->place,
            'firstName' => (string) $result->fname,
            'lastName' => (string) $result->lname,
            'member' => (int) $result->member_id,
            'result' => (string) $result->result,
            'type' => (string) $result->type,
            'typeID' => (int) $result->type_id,
            'creationDate' => (string) $result->created_at,
            'lastChange' => (string) $result->updated_at,
            'deletedDate' => isset($result->deleted_at) ? (string) $result->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
      $attributes = [
        'num' => 'id',
        'place' => 'place',
        'firstName' => 'fname',
        'lastName' => 'lname',
        'member' => 'member_id',
        'result' => 'result',
        'type' => 'type',
        'typeID' => 'type_id',
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
        'place' => 'place',
        'fname' => 'firstName',
        'lname' => 'lastName',
        'member_id' => 'member',
        'result' => 'result',
        'type' => 'type',
        'type_id' => 'typeID',
        'created_at' => 'creationDate',
        'updated_at' => 'lastChange',
        'deleted_at' => 'deletedDate',
      ];

      return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
