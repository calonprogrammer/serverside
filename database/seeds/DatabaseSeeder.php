<?php

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(UsersTableSeeder::class);
//        $this->call(FacilitiesTableSeeder::class);
//        $this->call(CitySeeder::class);
//        $this->call(PropertySeeder::class);
//$this->call(PremiumSeeder::class);
//        $this->call(ReviewSeeder::class);
        //$this->call(TransactionSeeder::class);
            $this->call(FollowSeeder::class);
//        $this->call(TagSeeder::class);
//            $this->call(ReportSeeder::class);
    }
}
