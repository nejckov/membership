<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Membership\Company;

class CompanyTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
     public function transform(Company $company)
     {
         return [
             'num' => $company->id,
             'title' => (string) $company->name,
             'details' => (string) $company->description,
             'active' => ($company->active === 1),
             'createdDate' => (string) $company->created_at,
             'lastChange' => (string) $company->updated_at,
             'dateOfDeleted' => isset($company->deleted_at) ? (string) $company->deleted_at : null,
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
