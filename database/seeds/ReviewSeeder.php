<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Faker\Provider\Uuid;
class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = ["fd8e7ff9-2fd6-3124-a734-9bdaa1002f19",
            "fbf618c0-e88a-3845-8e2f-c869d3f5c14a"];

        $properties = ["043ccc30-ecf6-3f42-87cd-97c022847b8f",
            "0685fcba-42df-3063-868e-2f3243489e85",
            "1232777d-663a-3173-979e-9e360e0f686b",
            "13e9a483-894c-3d49-99ee-015b6bc089b9",
            "19c92f37-5b96-3a24-9c20-8da707e12e2f",
            "1d88c99a-8ac9-3088-b7ce-0f76690c07c0",
            "2c77c336-c71a-34b9-889f-1b57f2287e26",
            "35f2b641-c452-389c-8ce8-23849ae41384",
            "3b891f10-8fb0-3a4e-b2e1-378f0f2fe1e5",
            "3f81e1cd-fdc6-38ed-86b5-1d46fca298fc"];
        $apart = '42adad9f-0f1b-3f35-add2-5bc6f09875dc';

        $faker = Faker\Factory::create();

        for($i = 0 ; $i < 10 ; $i++){
            for($j = 0 ; $j < 2 ; $j++){
                DB::table('reviews')->insert([
                    'id' => Uuid::uuid(),
                    'property_id' => $apart,
                    'user_id'=>$users[$j],
                    'content'=>$faker->paragraph($nbSentences = 2, $variableNbSentences = true),
                    'cleanliness'=>$faker->numberBetween($min = 1, $max = 5),
                    'room_facility'=>$faker->numberBetween($min = 1, $max = 5),
                    'public_facility'=>$faker->numberBetween($min = 1, $max = 5),
                    'security'=>$faker->numberBetween($min = 1, $max = 5),
                    'created_at'=>$faker->dateTime
                ]);
            }

        }

    }
}
