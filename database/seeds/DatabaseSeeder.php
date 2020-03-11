<?php

use Illuminate\Database\Seeder;

use App\Models\Membership\Section;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

      factory(App\Models\Membership\Post::class, 100)->create();
      $this->call(AgeGroupTableSeeder::class);
      factory(App\Models\Membership\Member::class, 50)->create();
      factory(App\Models\Membership\Section::class, 10)->create();
      factory(App\Models\Membership\MembershipYear::class, 16)->create();
      factory(App\Models\Membership\Role::class, 3)->create();
      factory(App\Models\Membership\Company::class, 3)->create();
      factory(App\User::class, 10)->create();
      factory(App\Models\Membership\Doc::class, 15)->create();
      factory(App\Models\Membership\Membership::class, 50)->create();
      factory(App\Models\Membership\MembershipSection::class, 250)->create();
      factory(App\Models\Membership\Fns::class, 15)->create();
      factory(App\Models\Membership\Committee::class, 30)->create();
      factory(App\Models\Membership\Competition::class, 20)->create();
      factory(App\Models\Membership\Category::class, 10)->create();
      factory(App\Models\Membership\Comment::class, 30)->create();
      factory(App\Models\Membership\Image::class, 20)->create();
      factory(App\Models\Membership\Result::class, 70)->create();
    }
}
