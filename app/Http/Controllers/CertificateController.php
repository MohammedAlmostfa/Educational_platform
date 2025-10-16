<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Services\CertificateService;
use App\Http\Resources\CertificateResource;
use App\Http\Requests\CertificateRequest\StoreCertificateRequest;
use App\Http\Requests\CertificateRequest\UpdateCertificateRequest;

class CertificateController extends Controller
{
    protected $certificateService;

    public function __construct(CertificateService $certificateService)
    {
        $this->certificateService = $certificateService;
    }

    /**
     * Display a listing of certificates.
     */
    public function index(Request $request)
    {
        $searchData = $request->input('search');
        $result = $this->certificateService->getAllCertificates($searchData);

        return $result['status'] === 200
            ? self::success(CertificateResource::collection($result['data']), $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Store a newly created certificate.
     */
    public function store(StoreCertificateRequest $request)
    {
        $data = $request->validated();
        $result = $this->certificateService->createCertificate($data);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Update the specified certificate.
     */
    public function update(UpdateCertificateRequest $request, Certificate $certificate)
    {
        $data = $request->validated();
        $result = $this->certificateService->updateCertificate($certificate, $data);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Remove the specified certificate.
     */
    public function destroy(Certificate $certificate)
    {
        $result = $this->certificateService->deleteCertificate($certificate);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Get certificates for the authenticated user
     */
    public function myCertificates(Request $request)
    {
        $searchData = $request->input('search');
        $result = $this->certificateService->getMyCertificates($searchData);

        return $result['status'] === 200
            ? self::success(CertificateResource::collection($result['data']), $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }
}
