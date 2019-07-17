<?php

use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =
            ["049b83d1-6416-3853-96a9-4635bff3622b",
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
            "9db5363f-6496-37d0-8350-623887b71825"];

        $properties =
            ["03c3a460-63f2-30b4-a8aa-c0b9d9a93df4",
                "0685fcba-42df-3063-868e-2f3243489e85",
                "12e3c0ed-b722-3310-b1ff-b4abfe84794e",
                "138925a5-7bd5-3fd8-b6d5-ead9b7aed238",
                "18002f9a-5fb7-3332-a876-f1cf467b26b7",
                "1c4e6a5d-968a-3cfb-891e-64c53c39e342",
                "1cba6734-e378-3f25-b046-288ec880bd80",
                "1d88c99a-8ac9-3088-b7ce-0f76690c07c0",
                "1ed4c389-5b2f-3fae-8c0c-aa86d7398fbe",
                "2a0e0ed7-666f-3572-8d0c-1797912caaa8",
                "2b8fe87b-4fbd-3b61-a10b-678e194d1fa8",
                "2def3cd2-1f62-3ff7-bb57-4fce3c2673e7",
                "310832af-a13c-3c4f-9078-e4c242743ce6",
                "3184f04f-cb13-3609-895d-9ab2d700b09b",
                "34b1c484-e4fb-3fa9-a49a-1db7da1ee1d0",
                "3c5e08be-1c6a-340c-a525-5f632ac431a5",
                "421fdd5e-c35f-36d5-bf0d-d3040e919f86",
                "42adad9f-0f1b-3f35-add2-5bc6f09875dc",
                "45336067-c86a-3032-b954-6eb279080b14",
                "469c2848-d550-3d0c-b906-b3640fe5a773",
                "478e3ca6-b8c2-312f-a3d0-04346ad33cbe",
                "493a2593-c361-3e7e-845b-4c3bc3195721",
                "4bace9f2-bd05-3640-9ccd-df61973a19a6"];
        $faker = \Faker\Factory::create();
        for($i = 0 ; $i < sizeof($users) ; $i++){
            DB::table('reports')->insert([
                'id' => \Faker\Provider\Uuid::uuid(),
                'user_id' => $users[$i],
                'property_id'=>$properties[$i],
                'content'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
            ]);
        }
    }
}
