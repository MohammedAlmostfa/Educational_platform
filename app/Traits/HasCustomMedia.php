<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

/**
 * Trait HasCustomMedia
 *
 * Provides reusable methods to handle media (images, videos, PDFs, etc.)
 * associated with an Eloquent model using a polymorphic relation.
 */
trait HasCustomMedia
{
    /**
     * Store or update a media file for the model.
     *
     * @param UploadedFile $file The uploaded file instance.
     * @param string|null $folderPrefix Optional folder prefix for storage (e.g. 'courses', 'users').
     * @param bool $deleteOld If true, deletes existing media before storing the new one.
     * @return \Illuminate\Database\Eloquent\Model|null The created media record.
     * @throws Exception If the model doesn't implement the `media()` relation.
     */
    public function storeMediaFile(UploadedFile $file, ?string $folderPrefix = null, bool $deleteOld = false)
    {
        // Ensure the model has a media() relationship
        if (!method_exists($this, 'media')) {
            throw new Exception("Model must define a media() relationship.");
        }

        // Optionally delete existing media
        if ($deleteOld) {
            $this->deleteMedia($this->media);
        }

        // Define storage folder: prefix or model name + date
        $folder = ($folderPrefix ?? strtolower(class_basename($this))) . '/' . now()->format('Y-m-d');

        // Store file on the 'public' disk
        $path = $file->store($folder, 'public');

        // Create a media record
        return $this->media()->create([
            'path'      => $path,
            'mime_type' => $file->getMimeType(),
            'type'      => $this->detectMediaType($file->getMimeType()), // optional helper
        ]);
    }

    /**
     * Delete one or more media records (and their files from storage).
     *
     * @param \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model $mediaCollection
     * @return void
     */
    public function deleteMedia($mediaCollection): void
    {
        $collection = is_iterable($mediaCollection) ? $mediaCollection : collect([$mediaCollection]);

        foreach ($collection as $media) {
            try {
                if (Storage::disk('public')->exists($media->path)) {
                    Storage::disk('public')->delete($media->path);
                    Log::info("Deleted media file", ['path' => $media->path]);
                }
                $media->delete();
            } catch (Exception $e) {
                Log::error("Failed to delete media", [
                    'id' => $media->id ?? null,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }

    /**
     * Detects a simple type label based on MIME type (e.g., image, video, document).
     *
     * @param string $mimeType
     * @return string
     */
    protected function detectMediaType(string $mimeType): string
    {
        if (str_starts_with($mimeType, 'image/')) return 'image';
        if (str_starts_with($mimeType, 'video/')) return 'video';
        if (str_starts_with($mimeType, 'audio/')) return 'audio';
        if (str_contains($mimeType, 'pdf')) return 'pdf';
        return 'file';
    }
}
