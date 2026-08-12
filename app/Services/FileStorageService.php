<?php

namespace App\Services;

use App\Models\File;
use App\Models\User;
use Exception;
use Illuminate\Http\UploadedFile;

class FileStorageService
{
    /**
     * Store a document in the storage
     * @param UploadedFile $upload
     * @param bool $visibility
     * @return File|string
     */
    public function storeDocument(UploadedFile $upload, bool $visibility): File | string
    {
        $path = $upload->store('files');

        try {
            $file = File::create([
                'filename' => $upload->getClientOriginalName(),
                'mime_type' => $upload->getClientMimeType(),
                'path' => $path,
                'visibility' => $visibility,
            ]);
        }
        catch (Exception $exception){
            return $exception->getMessage();
        }

        return $file;
    }

    /**
     * Store a portal logo in the service
     * @param UploadedFile $image
     * @param User $user
     * @param string $portalName
     * @return File|string
     */
    public function storePortalLogo(UploadedFile $image, string $portalName): File | string
    {
        $filename = $portalName.'.'.$image->getClientOriginalExtension();
        $path = $image->storeAs('profile-pictures', $filename, 'public');

        try {
            $file = File::create([
                'filename' => $filename,
                'mime_type' => $image->getClientMimeType(),
                'path' => $path,
                'visibility' => true,
            ]);
        }
        catch (Exception $exception){
            return $exception->getMessage();
        }

        return $file;
    }

    /**
     * Store a user logo in the service
     * @param User $user
     * @param UploadedFile $upload
     * @return File|string
     */
    public function storeUserProfilePicture(User $user, UploadedFile $upload): File | string
    {
        $filename = $user->name.$user->id.'.'.$upload->getClientOriginalExtension();
        $path = $upload->storeAs('profile-pictures', $filename, 'public');

        try {
            $file = File::create([
                'filename' => $filename,
                'mime_type' => $upload->getClientMimeType(),
                'path' => $path,
                'visibility' => true,
            ]);
        }
        catch (Exception $exception){
            return $exception->getMessage();
        }

        return $file;
    }
}
