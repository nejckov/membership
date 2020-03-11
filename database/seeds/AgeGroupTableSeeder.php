<?php

use Illuminate\Database\Seeder;

use App\Models\Membership\AgeGroup;

class AgeGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $age_group = new AgeGroup;
        $age_group->from = 1;
        $age_group->to = 10;
        $age_group->name = "otroci";
        $age_group->description = "otroci";
        $age_group->save();

        $age_group = new AgeGroup;
        $age_group->from = 11;
        $age_group->to = 20;
        $age_group->name = "mladosntiki";
        $age_group->description = "mlajši otroci";
        $age_group->save();

        $age_group = new AgeGroup;
        $age_group->from = 21;
        $age_group->to = 30;
        $age_group->name = "odrasli A";
        $age_group->description = "čisto prvi otroci";
        $age_group->save();

        $age_group = new AgeGroup;
        $age_group->from = 31;
        $age_group->to = 40;
        $age_group->name = "odrasli B";
        $age_group->description = "čisto prvi otroci";
        $age_group->save();

        $age_group = new AgeGroup;
        $age_group->from = 41;
        $age_group->to = 50;
        $age_group->name = "odrasli C";
        $age_group->description = "čisto prvi otroci";
        $age_group->save();

        $age_group = new AgeGroup;
        $age_group->from = 51;
        $age_group->to = 60;
        $age_group->name = "odrasli D";
        $age_group->description = "čisto prvi otroci";
        $age_group->save();

        $age_group = new AgeGroup;
        $age_group->from = 61;
        $age_group->to = 70;
        $age_group->name = "odrasli E";
        $age_group->description = "čisto prvi otroci";
        $age_group->save();

        $age_group = new AgeGroup;
        $age_group->from = 71;
        $age_group->to = 80;
        $age_group->name = "odrasli F";
        $age_group->description = "čisto prvi otroci";
        $age_group->save();

        $age_group = new AgeGroup;
        $age_group->from = 81;
        $age_group->to = 90;
        $age_group->name = "odrasli G";
        $age_group->description = "čisto prvi otroci";
        $age_group->save();

        $age_group = new AgeGroup;
        $age_group->from = 91;
        $age_group->to = 100;
        $age_group->name = "odrasli H";
        $age_group->description = "čisto prvi otroci";
        $age_group->save();

        $age_group = new AgeGroup;
        $age_group->from = 101;
        $age_group->to = 150;
        $age_group->name = "odrasli I";
        $age_group->description = "čisto prvi otroci";
        $age_group->save();
    }
}
