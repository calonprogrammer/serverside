<?php

use Illuminate\Database\Seeder;
use Faker\Provider\Uuid;
use Illuminate\Support\Str;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 0 ; $i < 40 ; $i ++) {
            $name = $faker->name;
            DB::table('users')->insert([
                'id' => Uuid::uuid(),
                'premium_id' => Uuid::uuid(),
                'name' => $name,
                'email' => $name . '@owner.com',
                'password' => bcrypt('secret'),
                'picture_id' => 'storage/image/user/profile.png',
                'phone' => '890890890',
                'type' => 2,
                'ban' => 0
            ]);
        }
            //admin
            DB::table('users')->insert([
                'id' => Uuid::uuid(),
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('adminadmin'),
                'picture_id' => 'storage/image/user/profile.png',
                'type' => 3,
                'ban' => 0
            ]);

            DB::table('users')->insert([
                'id' => Uuid::uuid(),
                'premium_id' => Uuid::uuid(),
                'name' => 'Owner',
                'email' => 'owner@owner.com',
                'password' => bcrypt('jkljkljkl'),
                'picture_id' => 'storage/image/user/profile.png',
                'phone' => '9090',
                'type' => 2,
                'ban' => 0
            ]);
        }
}
