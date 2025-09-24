<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Trait HasCustomMedia
 *
 * Provides functionality to store, update, and delete custom media files
 * (images, PDFs, videos, etc.) associated with a model.
 */
trait HasCustomMedia
{
    /**
     * Store or update a media file for the model.
     *
     * @param UploadedFile $file The uploaded file instance
     * @param string|null $folderPrefix Optional folder prefix for storage
     * @param bool $deleteOld If true, deletes old media files before storing new
     * @return \Illuminate\Database\Eloquent\Model|null The created media model
     * @throws \Exception If the model does not have a media() relationship
     */
    public function storeMediaFile(UploadedFile $file, string $folderPrefix = null, bool $deleteOld = false)
    {
        // Ensure the model has a media() relationship
        if (!method_exists($this, 'media')) {
            throw new \Exception("Model must have a media() relationship.");
        }

        // Delete old media files if requested
        if ($deleteOld) {
            $oldMedia = $this->media()->get();
            foreach ($oldMedia as $media) {
                if (Storage::disk('public')->exists($media->path)) {
                    Storage::disk('public')->delete($media->path);
                }
                $media->delete(); // Delete record from database
            }
        }

        // Determine storage folder: prefix or model name + current date
        $folder = ($folderPrefix ?? strtolower(class_basename($this))) . '/' . now()->format('Y-m-d');

        // Store the file in the public disk
        $path = $file->store($folder, 'public');

        // Save media record in the database
        return $this->media()->create([
            'path'      => $path,
            'mime_type' => $file->getMimeType(),
        ]);
    }

    /**
     * Delete associated media files from storage and database.
     *
     * @param \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Database\Eloquent\Collection $mediaCollection Collection of media models
     * @return void
     */
    public function deleteMedia($mediaCollection)
    {
        foreach ($mediaCollection as $media) {
            // Check if the file exists in storage and delete it
            if (Storage::disk('public')->exists($media->url)) {
                Log::info("Deleting media URL:", ['url' => $media->url]);
                Storage::disk('public')->delete($media->url);
            }
            $media->delete(); // Delete record from database
        }
    }
}
