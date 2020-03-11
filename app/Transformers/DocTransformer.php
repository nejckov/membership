<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Membership\Doc;

class DocTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Doc $doc)
    {
        return [
            'num' => (int) $doc->id,
            'membership' => ($doc->type === 'membership'),
            'document' => (string) $doc->reference,
            'membershipYear' => (int) $doc->membership_year_id,
            'membershipYearTitle' => (string) $doc->membershipyear->type . ' ' .$doc->membershipyear->year,
            'section' => (int) $doc->section_id,
            'sectiontitle' => (string) $doc->section->name ,
            'createdDate' => (string) $doc->created_at->format('d.m.Y'),
            'lastChange' => (string) $doc->updated_at,
            'dateOfDeleted' => isset($doc->deleted_at) ? (string) $doc->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'num' => 'id',
            'membership' => 'membership',
            'document' => 'reference',
            'membershipYear' => 'membership_year_id',
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
          'membership' => 'membership',
          'reference' => 'document',
          'membership_year_id' => 'membershipYear',
          'created_at' => 'creationDate',
          'updated_at' => 'lastChange',
          'deleted_at' => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
