<?php

use Faker\Factory;
use Faker\Provider\Lorem;
use Faker\Provider\Uuid;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $facilities = [
            '1d84952b-be0d-30b4-9586-d1f2146d5caf',
            '2080ade6-f202-3053-8513-444c3ab3bff9',
            '33446296-372b-3a46-8a46-073267b8d1a2',
            'a145af8e-8d5a-36f0-8b04-65a278c3fee0'
        ];
        $users = ["fd8e7ff9-2fd6-3124-a734-9bdaa1002f19",
            "fbf618c0-e88a-3845-8e2f-c869d3f5c14a",
            "fab16f11-f6b2-3bba-93be-d38a1bd1abd8",
            "f48cc5b0-e662-3ba2-965c-840b3eeba1d2",
            "ec149e1e-a1e1-3b80-af0f-45eed06f60b2",
            "eba39b25-29f1-3333-8fc4-5265d9583de1",
            "e4d61002-c6fa-3201-9aa2-34d2f490d568",
            "de48ce72-603e-3104-a6ea-7c5735d5a856",
            "dc0310ad-879c-377a-9e10-76e7e68c4ae0",
            "cbe09b19-7cbd-37d9-9620-31cb3df5b96b",
            "c630c47e-5f05-3d88-9ef5-4491a3cd256d",
            "ba52c099-d5b7-3f90-bdbe-f0c0c87338bc",
            "b8bf1a0e-79ff-3969-a2d0-9621dfaebc86",
            "b1044dbe-46de-38b6-97fc-ee54def2fdf7",
            "aa608e93-3160-3e52-9a66-364f0f1eb302",
            "a9c67b6a-8684-3cdc-9800-086d2ac92efd",
            "a7060385-3da3-312e-a737-a999c0752b62",
            "a0eb8c55-3844-31dc-8031-20626ae992f2",
            "9db5363f-6496-37d0-8350-623887b71825",
            "9bfca24d-19c2-3c10-94d7-5028411c9150"];

        $cities =["020b303f-8ec3-3377-869b-c5f8d19e3b70",
            "02a4278c-e667-37d8-9f3f-ecca2e0793df",
            "033a2a71-2879-3c6c-af2d-ad0b86993fdf",
            "044833d3-75e1-3676-b41d-ce59e32f7b60",
            "05da0f86-88ec-32e6-aa93-37ddd8fdd22d",
            "06b325b5-d41c-3a03-b836-95c23424cfbf",
            "0701b93d-20cf-3424-831d-21c2bd5dc121",
            "0d788c98-7703-3763-9988-666eb5c6b005",
            "15ad129b-e74b-397e-8870-98a699c616ab",
            "1731db8b-71a4-3114-a3ff-7f4a6a387d84",
            "1754c51d-7942-386c-bafd-a2cf7e9a5c77",
            "1ca5d7fd-b486-3f8e-9912-283829b2b014",
            "1f62457e-e71a-3583-9c2e-ca47f2955583",
            "206d66e9-f4ac-3fbe-a276-41f0a080f8b6",
            "2459feeb-ceb9-36e0-b63f-2ed9e41a91c7",
            "279594f0-a328-324a-9c10-3e430730457a",
            "2f28f9a5-bed7-3c7f-89c0-b0fea1c0725f",
            "2f4c6f58-82ca-39de-be19-06749757a23a",
            "30a4de78-4710-3d89-a18f-3b93af0e58e7",
            "31e3e8c0-0426-34b0-b82a-5ba29c43395c"];
        //apart seeder
        $user = 'a7fbe685-30c7-328a-a177-7a4ccc259f1f';
        for($i = 0 ; $i < 20 ; $i ++){
            $idApart = Uuid::uuid();
            $name = $faker->name;
            $description = $faker->paragraph($nbSentences = 1, $variableNbSentences = true);
            $area = $faker->numberBetween($min = 30, $max = 80);
            $fees = $faker->numberBetween($min = 100000, $max = 500000);
            $price = $faker->numberBetween($min = 1000000, $max = 5000000);
            $latitude = $faker->latitude($min = -6.198912, $max = -6.21462);
            $longitude =$faker->longitude($min = 106.775920, $max = 106.84513);
            DB::table('properties')->insert([
                'id' => $idApart,
                'user_id'=>$user,
                'name' =>$name,
                'banner_id' => 'storage/image/property/defaultBanner.jpg',
                'pict_id' => 'storage/image/property/defaultPictId.png',
                'pict360_id' => 'storage/image/property/defaultPict360.jpg',
                'description' => $description,
                'area' => $area,
                'additional_information'=> $description,
                'additional_fees' => $fees,
                'price'=>$price,
                'period'=>'month',
                'city_id'=>$cities[$i],
                'longitude'=> $longitude,
                'latitude' => $latitude,
                'address'=>$faker->address,
                'propertiable_id' => $idApart,
                'propertiable_type' => 'App\Apartement',
                'slug'=> str_slug($name)."-".$idApart."-apartement"

            ]);
            DB::table('apartements')->insert([
                'id' =>$idApart,
                'unit_type' => 'Studio',
                'unit_condition' => 'Baru',
                'unit_floor' => 20,
                'furnished'=>'furnished'
            ]);
            for($j = 0 ; $j < sizeof($facilities) ;$j++){
                DB::table('property_facilities_pivot')->insert([
                    'property_id' => $idApart,
                    'facility_id'=> $facilities[$j]
                ]);
            }
        }

        for($i = 0 ; $i < 20 ; $i ++){
            $idKost = Uuid::uuid();
            $name = $faker->name;
            $description = $faker->paragraph($nbSentences = 1, $variableNbSentences = true);
            $area = $faker->numberBetween($min = 30, $max = 80);
            $fees = $faker->numberBetween($min = 100000, $max = 500000);
            $price = $faker->numberBetween($min = 1000000, $max = 5000000);
            $latitude = $faker->latitude($min = -6.198912, $max = -6.21462);
            $longitude =$faker->longitude($min = 106.775920, $max = 106.84513);
            DB::table('properties')->insert([
                'id' => $idKost,
                'user_id'=>$user,
                'name' =>$name,
                'banner_id' => 'storage/image/property/defaultBanner.jpg',
                'pict_id' => 'storage/image/property/defaultPictId.png',
                'pict360_id' => 'storage/image/property/defaultPict360.jpg',
                'description' => $description,
                'area' => $area,
                'additional_information'=> $description,
                'additional_fees' => $fees,
                'price'=>$price,
                'period'=>'month',
                'city_id'=>$cities[$i],
                'longitude'=> $longitude,
                'latitude' => $latitude,
                'address'=>$faker->address,
                'propertiable_id' => $idKost,
                'propertiable_type'=> 'App\House',
                'slug'=> str_slug($name)."-".$idKost."-kost"
            ]);
            DB::table('houses')->insert([
                'id' =>$idKost,
                'room_remaining' => 10,
                'gender_type' => 'Campur'
            ]);
            for($j = 0 ; $j < sizeof($facilities) ;$j++){
                DB::table('property_facilities_pivot')->insert([
                    'property_id' => $idKost,
                    'facility_id'=> $facilities[$j]
                ]);
            }
        }
    }
}
