<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HandlesImageUploads
{
    /**
     * Upload an image to the public storage disk and remove old image if provided.
     */
    protected function uploadImage(UploadedFile $file, string $folder = 'images', ?string $oldPath = null): string
    {
        if ($oldPath) {
            $this->deleteImage($oldPath);
        }

        return $file->store("uploads/{$folder}", 'public');
    }

    /**
     * Delete an image from the public storage disk if exists.
     */
    protected function deleteImage(?string $path): bool
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }
}
