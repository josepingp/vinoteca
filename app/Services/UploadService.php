<?php

namespace App\Services;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    public static function upload(UploadedFile $file, string $folder, string $disk = 'public', string $filename = 'public'): string
    {
        //filename without extension
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        //extension
        $extension = $file->getClientOriginalExtension();
        //add time to filename
        $filename = $filename . '_' . time() . '.' . $extension;

        return $file->storeAs($folder, $filename, $disk);
    }

    public static function delete(string $path, string $disk = 'public'): bool
    {
        if (!Storage::disk($disk)->exists($path)) {
            return false;
        }

        return Storage::disk($disk)->delete($path);
    }

    public static function url(string $path, string $disk = 'public'): string
    {
        return Storage::disk($disk)->url($path);
    }
}
