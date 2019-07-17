<?php

use Faker\Provider\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FacilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $public = [
            ['24Hours','storage/image/facilities/public/24h.png'],
            ['ATM','storage/image/facilities/public/ATM.png'],
            ['Kitchen','storage/image/facilities/public/kitchen.png']
        ];
        $parking = [
            ['Mobil','storage/image/facilities/parking/mobil.png'],
            ['Motor','storage/image/facilities/parking/motor.png']
        ];
        $unit = [
            ['AC','storage/image/facilities/unit/AC.png'],
            ['Air Panas','storage/image/facilities/unit/Air-Panas.png'],
            ['Kasur','storage/image/facilities/unit/Kasur.png'],
            ['TV Kabel','storage/image/facilities/unit/Tv-Kabel.png'],
            ['Wifi','storage/image/facilities/unit/Wifi.png']
        ];


        for($i = 0 ; $i < sizeof($unit) ; $i++){
            DB::table('facilities')->insert([
                'id' => Uuid::uuid(),
                'name' => $unit[$i][0],
                'link' => $unit[$i][1],
                'type' => 1
            ]);
        }
        for($i = 0 ; $i < sizeof($public) ; $i++){
            DB::table('facilities')->insert([
                'id' => Uuid::uuid(),
                'name' => $public[$i][0],
                'link' => $public[$i][1],
                'type' => 2
            ]);
        }
        for($i = 0 ; $i < sizeof($parking) ; $i++){
            DB::table('facilities')->insert([
                'id' => Uuid::uuid(),
                'name' => $parking[$i][0],
                'link' => $parking[$i][1],
                'type' => 3
            ]);
        }

    }
}
