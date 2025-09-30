<?php

namespace App\Http\Controllers;

use App\Services\GovernorateService;

class GovernorateController extends Controller
{
    private $governorateService;

    public function __construct(GovernorateService $governorateService)
    {
        $this->governorateService = $governorateService;
    }

    public function index()
    {
        $result = $this->governorateService->getGovernorates();

        return $result['status'] === 200
            ? self::success($result['data'], $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }
}

