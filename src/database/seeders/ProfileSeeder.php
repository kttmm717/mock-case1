<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'postcode' => 9591111,
            'address' => '新潟県新潟市中央区',
            'building' => 'マンション1'
        ];
        Profile::create($param);

        $param = [
            'user_id' => 2,
            'postcode' => 9592222,
            'address' => '新潟県燕市吉田',
            'building' => 'マンション2'
        ];
        Profile::create($param);
    }
}
