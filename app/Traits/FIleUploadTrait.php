<?php

namespace App\Traits;

/**
 * Trait for handling file upload
 * 
 * @author Hridoy
 */
trait FIleUploadTrait
{
    /**
     * Upload file.
     * 
     * @param
     * 
     * @return
     */
    protected function FileUpload($file, string $file_name, string $file_name_prefix): string
    {
        $fileName = "{$file_name_prefix}_{$file_name}_" . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path("{$file_name_prefix}_{$file_name}s"), $fileName);
        return asset("{$file_name_prefix}_{$file_name}s/" . $fileName);
    }
}