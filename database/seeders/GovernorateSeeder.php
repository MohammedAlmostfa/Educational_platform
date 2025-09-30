<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Governorate;

class GovernorateSeeder extends Seeder
{
    public function run()
    {
        $governorates = [
            'دمشق',
            'ريف دمشق',
            'حلب',
            'حمص',
            'حماه',
            'اللاذقية',
            'طرطوس',
            'دير الزور',
            'الرقة',
            'الحسكة',
            'درعا',
            'القنيطرة',
            'إدلب',
            'السويداء',
            'خارج سوريا'
        ];

        foreach ($governorates as $name) {
            Governorate::updateOrCreate(['name' => $name]);
        }
    }
}
