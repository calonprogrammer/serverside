<?php

use Faker\Provider\Uuid;
use Illuminate\Database\Seeder;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        for($i = 0 ; $i < sizeof($users) ; $i++){
            DB::table('follows')->insert([
                'id' => Uuid::uuid(),
                'from_id'=> $users[$i],
                'to_id' => "a7fbe685-30c7-328a-a177-7a4ccc259f1f"
            ]);
        }
    }
}
