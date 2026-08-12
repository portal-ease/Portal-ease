<?php

namespace App\Services;

use App\Models\File;
use App\Models\Portal;
use App\Models\User;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    /**
     * Download a file or image
     * @param File $file
     * @return StreamedResponse
     */
    public function download(File $file): StreamedResponse
    {
        return Storage::download($file->path, $file->filename);
    }

    /**
     * Find the logo url of the given portal
     * @param Portal $portal
     * @return string|null
     */
    public function portalLogoUrl(Portal $portal): string | null
    {
        $logoPath = null;

        if (Storage::disk('public')->exists('profile-pictures/' . $portal->name . '.jpg')) {
            $logoPath = Storage::url('profile-pictures/' . $portal->name . '.jpg');
        } elseif (Storage::disk('public')->exists('profile-pictures/' . $portal->name . '.png')) {
            $logoPath = Storage::url('profile-pictures/' . $portal->name . '.png');
        }

        return $logoPath;
    }

    /**
     * Rename the portal logo
     * @param Portal $portal
     * @param UploadedFile $upload
     * @return void
     */
    public function renamePortalLogo(Portal $portal, UploadedFile $upload): void
    {
        $extensions = ['jpg', 'png'];
        $oldFileName = null;

        // Detect existing file
        foreach ($extensions as $ext) {
            $filePath = "profile-pictures/{$portal->name}.{$ext}";
            if (Storage::disk('public')->exists($filePath)) {
                $oldFileName = "{$portal->name}.{$ext}";
                break;
            }
        }

        $newFileName = $portal->name.'.jpg'; // Always rename to jpg

        // Move file if found
        if ($oldFileName) {
            Storage::disk('public')->move(
                "profile-pictures/{$oldFileName}",
                "profile-pictures/{$newFileName}"
            );
        }

        // Update file record
        $file = File::whereIn('filename', [
            "{$portal->name}.jpg",
            "{$portal->name}.png",
        ])->first();

        if ($file) {
            $file->update(['filename' => $newFileName]);
        }
    }

    /**
     * Delete a file from the storage and database
     * @param File $file
     * @return void
     */
    public function delete(File $file): void
    {
        $file->delete();
    }
}
