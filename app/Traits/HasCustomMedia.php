<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait HasCustomMedia
{
    /**
     * Store a file (image, pdf, video, etc.) for the model.
     *
     * @param UploadedFile $file
     * @param string|null $folderPrefix Optional folder prefix for storage
     * @param bool $deleteOld Delete old files if true
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function storeMediaFile(UploadedFile $file, string $folderPrefix = null, bool $deleteOld = false)
    {
        if ($deleteOld && method_exists($this, 'media')) {
            $this->media()->delete();
        }

        $folder = ($folderPrefix ?? strtolower(class_basename($this))) . '/' . now()->format('Y-m-d');

        $path = $file->store($folder, 'public');

        return $this->media()->create([
            'path'      => $path,
            'mime_type' => $file->getMimeType(),
        ]);
    }
}
