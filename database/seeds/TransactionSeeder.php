<?php

use Faker\Factory;
use Faker\Provider\Uuid;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = ["049b83d1-6416-3853-96a9-4635bff3622b",
            "04f07aca-7549-3d06-be36-45c660ab8853",
            "068bd47b-e48b-33a1-9b30-005c3332f48c",
            "09e1ed60-1c7b-38a1-9c70-97fcd49417b1",
            "10dd189e-c048-38b7-ad8b-929590c5e9f7",
            "1ad9bc15-9dd7-3117-8186-23328ac5c2d6",
            "1d7f1831-f335-319b-8976-3b5f80d3eddc",
            "357456bc-faf7-3b73-b67e-17f3d5097340",
            "443678d5-ed45-3110-b36f-88316608b7e7",
            "4c842e53-31f7-3a6b-a170-4b6166d01f1f",
            "53375254-e308-3eca-b25f-95adf9c59b32",
            "5627ea80-c44d-3111-b313-fe8b7d0ecf4e",
            "57e32a38-8c3b-38ce-a0a6-9cc8a7cc2fe4",
            "5a78c17c-fd10-3f52-8550-5f88317067ae",
            "6d326cf0-5fb5-343b-b370-9aa149c97561",
            "7fc70c44-0866-3939-9742-50fff5023e76",
            "80685598-eb67-34f7-971b-7b6807e114fa",
            "84bf05e8-daf1-327c-8153-f2070f87547b",
            "88d45dc7-e3fe-35b0-a17c-10755862bfc5",
            "8bdf794e-5d61-3dff-b2a5-56d143f3fc0b",
            "9439fe59-2b51-30b2-8e18-7a8664307920",
            "9bfca24d-19c2-3c10-94d7-5028411c9150",
            "9db5363f-6496-37d0-8350-623887b71825",
            "a0eb8c55-3844-31dc-8031-20626ae992f2"];

        $premiums = ["030e6068-8539-3c22-88c0-2993c5cb7170",
            "088398cf-d1dd-3b6b-900a-ff5124122279",
            "0f691fe9-a035-323e-be4f-c32b6eb2f60d",
            "10a37fde-91e9-37ae-a5a1-7faa75d05bb0",
            "15b0cb16-8f17-30fb-8ef3-789ab879d14c",
            "186ae311-be53-3509-a6b8-e35b6af181b9",
            "2241b23b-c3ef-3a22-84ce-9c67312e7a58",
            "2acd91db-c317-3be8-8c7e-fdaa4b9ed347",
            "2d726250-2b71-3de6-9985-8149ab20cba2",
            "300be855-db60-3a1a-935e-648b2dbc5ccb",
            "317efbdd-6444-3932-b7e5-eb3db18f4cb7",
            "331a72c6-01f0-318b-93c8-c7329ec7c8ce",
            "3fdd9de1-3eb0-3ced-b337-4a9e280b81ba",
            "41ef95dd-43c7-3fd9-a0df-078d84ca8065",
            "42187d1d-192b-38c3-964b-383c67c94420",
            "5e8985fc-d8b3-3d8a-90a8-81be5c5932c1",
            "5eef588f-c614-3c47-ab28-4bee48afb98b",
            "6d43103c-590d-30d4-a87f-3084d466d1a9",
            "6fe61f24-accf-3a23-9bfc-bf1005c1a7c6",
            "7626e995-1f3e-39ab-be6d-e8b3695349e3",
            "786c0dd9-927e-3e3f-aebc-8ed2d9f2c37f",
            "79b4721f-14fc-36fc-8aed-496b45e90717",
            "7b01ddf0-a758-30b6-b634-7ade838179ac",
            "7c5b38ac-bc56-33b8-90de-fc3c55bfe945"];

        $faker = Faker\Factory::create();

        for($i = 0 ; $i < sizeof($users) ; $i++){
                DB::table('transactions')->insert([
                    'id' => Uuid::uuid(),
                    'user_id' => $users[$i],
                    'premium_id'=>$premiums[$i],
                    'start_date'=>$faker->dateTime(),
                    'end_date'=>$faker->dateTime(),
                    'premium_status'=> 1
                ]);
        }
    }
}
