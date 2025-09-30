<?php
namespace App\Services;

use App\Models\Governorate;

class GovernorateService
{
    public function getGovernorates()
    {
        $governorates = Governorate::select('id', 'name')->get();

        return [
            'status' => 200,
            'message' => 'تم جلب قائمة المحافظات بنجاح.',
            'data' => $governorates,
        ];
    }
}
