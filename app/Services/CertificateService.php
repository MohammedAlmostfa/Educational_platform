<?php

namespace App\Services;

use App\Models\Certificate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * CertificateService
 *
 * Service for managing Certificate entities, including:
 * - CRUD operations
 * - Handling associated media files
 * - Retrieving certificates for all users or the authenticated user
 */
class CertificateService
{
    /**
     * Retrieve all certificates with related media, user, and course.
     * Optionally filter by search term.
     *
     * @param string|null $searchTerm
     * @return array
     */
    public function getAllCertificates($searchTerm = null): array
    {
        $certificates = Certificate::with(['media', 'user', 'course'])
            ->when(!empty($searchTerm), function ($query) use ($searchTerm) {
                $query->search($searchTerm);
            })
            ->get();

        return [
            'status'  => 200,
            'message' => 'تم استرجاع جميع الشهادات بنجاح',
            'data'    => $certificates,
        ];
    }

    /**
     * Retrieve all certificates for the currently authenticated user.
     * Optionally filter by search term.
     *
     * @param string|null $searchTerm
     * @return array
     */
    public function getMyCertificates($searchTerm = null): array
    {
        $user = Auth::user();

        $certificates = $user->certificates()
            ->with(['media', 'course'])
            ->when(!empty($searchTerm), function ($query) use ($searchTerm) {
                $query->search($searchTerm);
            })
            ->get();

        return [
            'status'  => 200,
            'message' => 'تم استرجاع جميع الشهادات الخاصة بك بنجاح',
            'data'    => $certificates,
        ];
    }

    /**
     * Create a new certificate and optionally upload an associated media file.
     *
     * @param array $data
     * @return array
     */
    public function createCertificate(array $data): array
    {
        return DB::transaction(function () use ($data) {

            $certificate = Certificate::create($data);


            if (!empty($data['file'])) {
                $certificate->storeMediaFile($data['file'], 'certificates/files', true);
            }

            return [
                'status'  => 200,
                'message' => 'تم إنشاء الشهادة بنجاح',
                'data'    => $certificate,
            ];
        });
    }

    /**
     * Update an existing certificate and optionally replace its media file.
     *
     * @param Certificate $certificate
     * @param array $data
     * @return array
     */
    public function updateCertificate(Certificate $certificate, array $data): array
    {
        return DB::transaction(function () use ($certificate, $data) {

            $certificate->update($data);


            if (!empty($data['file'])) {
                  $certificate->deleteMedia($certificate->media);

            $certificate->media()->delete();


                $certificate->storeMediaFile($data['file'], 'certificates/files', true);
            }

            return [
                'status'  => 200,
                'message' => 'تم تحديث الشهادة بنجاح',
                'data'    => $certificate,
            ];
        });
    }

    /**
     * Delete a certificate along with all its associated media files.
     *
     * @param Certificate $certificate
     * @return array
     */
    public function deleteCertificate(Certificate $certificate): array
    {
        return DB::transaction(function () use ($certificate) {

            $certificate->deleteMedia($certificate->media);

            $certificate->media()->delete();


            $certificate->delete();

            return [
                'status'  => 200,
                'message' => 'تم حذف الشهادة وجميع الملفات المرتبطة بها بنجاح',
                'data'    => null,
            ];
        });
    }
}
