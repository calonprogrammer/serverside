<?php

use Faker\Factory;
use Faker\Provider\Uuid;
use Illuminate\Database\Seeder;

class PremiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();


        for($i = 0 ; $i < 10 ; $i++){
            $discount = $faker->numberBetween($min = 10, $max = 100);
            $duration =$faker->numberBetween($min = 10, $max = 60);
                DB::table('premiums')->insert([
                'id' => Uuid::uuid(),
                'name'=> $faker->name,
                'discount' => $discount,
                'duration'=> $duration
            ]);
        }
    }
}
