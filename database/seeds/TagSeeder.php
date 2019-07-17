<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Faker\Provider\Uuid;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $name =
            ["apartemen",
            "apartment",
            "apartement",
            "kost",
            "apartement kost",
            "sewa apartemen",
            "apartments",
            "dekorasi apartemen",
            "studio apartments",
            "new apartment",
            "anak kost",
            "apartemen jakarta",
            "apartemen 35 meter",
            "apartemen unik",
            "apartemen batavia",
            "interior apartemen",
            "inspirasi apartemen",
            "apartemen design",
            "apartment toronto",
            "desain interior apartemen",
            "kostan",
            "kost bogor",
            "kosan dekat ipb",
            "cafe kosan",
            "binus alam sutera",
            "apartemen bsd",
            "apartemen tangerang",
            "apartemen alam sutera",
            "binus university",
            "apartemen dekat binus",
            "apartemen gading serpong",
            "alam sutera",
            "servis apartemen",
            "dijual apartemen",
            "binus pusat",
            "kost jakarta",
            "apartemen bsd city",
            "service apartment",
            "apartemen sewa",
            "apartemen murah",
            "apartemen lloyd",
            "apartemen dekat ikea",
            "apartemen dijual"];
        for($i = 0 ; $i < sizeof($name); $i++){
            DB::table('tags')->insert([
                'id' => Uuid::uuid(),
                'slug'=> $name[$i],
                'name'=>$name[$i]
        ]);
        }

    }
}
