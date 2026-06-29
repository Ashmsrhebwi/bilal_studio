<?php

namespace App\Services;

use App\Models\MediaLibrary;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class MediaService
{
    private string $disk = 'public';

    public function upload(UploadedFile $file, string $folder = 'media', ?string $altAr = null, ?string $altEn = null): MediaLibrary
    {
        $fileName  = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $filePath  = "{$folder}/{$fileName}";
        $mimeType  = $file->getMimeType();
        $fileType  = $this->resolveFileType($mimeType);
        $thumbnail = null;
        $width = $height = null;

        // Store original file
        Storage::disk($this->disk)->put($filePath, file_get_contents($file));

        // Generate thumbnail for images
        if ($fileType === 'image') {
            [$width, $height, $thumbnail] = $this->generateThumbnail($file, $folder, $fileName);
        }

        return MediaLibrary::create([
            'file_name'      => $file->getClientOriginalName(),
            'file_path'      => $filePath,
            'file_type'      => $fileType,
            'mime_type'      => $mimeType,
            'file_size'      => $file->getSize(),
            'thumbnail_path' => $thumbnail,
            'width'          => $width,
            'height'         => $height,
            'alt_text_ar'    => $altAr,
            'alt_text_en'    => $altEn,
            'disk'           => $this->disk,
            'mediable_type'  => null,
            'mediable_id'    => null,
        ]);
    }

    private function generateThumbnail(UploadedFile $file, string $folder, string $fileName): array
    {
        try {
            $image = Image::read($file->getRealPath());
            $width  = $image->width();
            $height = $image->height();

            $thumbName = 'thumb_' . $fileName;
            $thumbPath = "{$folder}/{$thumbName}";

            $thumb = $image->scale(width: 400);
            Storage::disk($this->disk)->put($thumbPath, $thumb->toJpeg(80)->toString());

            return [$width, $height, $thumbPath];
        } catch (\Throwable) {
            return [null, null, null];
        }
    }

    private function resolveFileType(string $mime): string
    {
        if (str_starts_with($mime, 'image/')) return 'image';
        if (str_starts_with($mime, 'video/')) return 'video';
        return 'document';
    }

    public function delete(MediaLibrary $media): void
    {
        Storage::disk($media->disk)->delete($media->file_path);
        if ($media->thumbnail_path) {
            Storage::disk($media->disk)->delete($media->thumbnail_path);
        }
        $media->delete();
    }

    public function storeImageFromPath(string $sourcePath, string $folder = 'media'): string
    {
        $fileName = Str::uuid() . '.jpg';
        $destPath = "{$folder}/{$fileName}";
        Storage::disk($this->disk)->copy($sourcePath, $destPath);
        return $destPath;
    }
}
