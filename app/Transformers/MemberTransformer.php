<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Models\Membership\Member;

class MemberTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Member $member)
    {
        return [
            'num' => (int) $member->id,
            'firstName' => (string) $member->fname,
            'lastName' => (string) $member->lname,
            'address' => (string) $member->address,
            'email' => (string) $member->email,
            'birth' => (string) $member->birth,
            'sex' => (string) $member->gender === 'm' ? 'Male' : 'Female',
            'cn' => (string) $member->custom_number,
            'postID' => (int) $member->post_id,
            'post' => $member->post->name,
            'details' => (string) $member->description,
            'active' => ($member->active === 1),
            'telephone' => (string) $member->mobile,
            'creationDate' => (string) $member->created_at,
            'lastChange' => (string) $member->updated_at,
            'deletedDate' => isset ($member->deleted_at) ? (string)$member->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'num' => 'id',
            'firstName' => 'fname',
            'lastName' => 'lname',
            'address' => 'address',
            'email' => 'email',
            'birth' => 'birthdate',
            'cn' => 'custom_number',
            'sex' => 'gender',
            'postID' => 'post_id',
            'postTitle' => 'post_name',
            'details' => 'description',
            'active' => 'active',
            'telephone' => 'mobile',
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
          'fname' => 'firstName',
          'lname' => 'lastName',
          'address' => 'address',
          'email' => 'email',
          'birthdate' => 'birth',
          'custom_number' => 'cn',
          'gender' => 'sex',
          'post_id' => 'postID',
          'post_name' => 'postTitle',
          'description' => 'details',
          'active' => 'active',
          'mobile' => 'telephone',
          'created_at' => 'creationDate',
          'updated_at' => 'lastChange',
          'deleted_at' => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
