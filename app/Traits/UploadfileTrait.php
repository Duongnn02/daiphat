<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadFileTrait
{
    public function uploadFile($requestFile, $folder, $disk = 'public', $filename = null)
    {
        ini_set('memory_limit', '256M');
        try {
            $FileName = !is_null($filename) ? $filename : Str::random(10);
            return 'storage/'. $requestFile->storeAs(
                $folder,
                $FileName . "." . $requestFile->getClientOriginalExtension(),
                $disk
            );

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }

    // delete file
    public function deleteFile(array $fileNames, $disk = 'public')
    {
        try {
            if ($fileNames) {
                foreach ($fileNames as $fileName) {
                    Storage::delete($disk . '/' . $fileName);
                }
            }
            return true;
        } catch (\Exception $e) {
            report($e);
            return $e->getMessage();
        }
    }
}
