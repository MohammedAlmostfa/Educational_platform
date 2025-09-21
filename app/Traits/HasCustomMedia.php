<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait HasCustomMedia
{
    /**
     * Store or update a file (image, pdf, video, etc.) for the model.
     *
     * @param UploadedFile $file
     * @param string|null $folderPrefix Optional folder prefix for storage
     * @param bool $deleteOld Delete old files if true
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function storeMediaFile(UploadedFile $file, string $folderPrefix = null, bool $deleteOld = false)
    {
        // تحقق من وجود علاقة media
        if (!method_exists($this, 'media')) {
            throw new \Exception("Model must have a media() relationship.");
        }

        if ($deleteOld) {
            $oldMedia = $this->media()->get();
            foreach ($oldMedia as $media) {
                if (Storage::disk('public')->exists($media->path)) {
                    Storage::disk('public')->delete($media->path); //
                }
                $media->delete();
            }
        }


        $folder = ($folderPrefix ?? strtolower(class_basename($this))) . '/' . now()->format('Y-m-d');

        $path = $file->store($folder, 'public');

        return $this->media()->create([
            'path'      => $path,
            'mime_type' => $file->getMimeType(),
        ]);
    }

     /**
     * Delete associated media files from storage and database.
     *
     * @param \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Database\Eloquent\Collection $mediaCollection
     */


public function deleteMedia($mediaCollection)
{
    foreach ($mediaCollection as $media) {
        if (Storage::disk('public')->exists($media->url)) {
            Log::info("url",$media->url);
            Storage::disk('public')->delete($media->url);
        }
        $media->delete();
    }
}

}
