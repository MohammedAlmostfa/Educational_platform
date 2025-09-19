<?php

namespace App\Services;

use App\Models\Country;

/**
 * Service for handling country-related operations.
 */
class CountryService
{
    /**
     * Retrieve all countries.
     *
     * @return array Structured response containing message, data, and status.
     */
    public function getCountries()
    {
        $countries = Country::select('id', 'name')->get();

        return [
            'status' => 200,
            'message' => 'تم جلب قائمة الدول بنجاح.',
            'data' => $countries,
        ];
    }
}
