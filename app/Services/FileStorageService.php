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

        return $this->createFile($upload->getClientOriginalName(),
            $upload->getClientMimeType(), $path, $visibility);
    }

    /**
     * Store a portal logo in the service
     * @param UploadedFile $image
     * @param string $portalName
     * @return File|string
     */
    public function storePortalLogo(UploadedFile $image, string $portalName): File | string
    {
        $filename = $portalName.'.'.$image->getClientOriginalExtension();
        $path = $image->storeAs('profile-pictures', $filename, 'public');

        return $this->createFile($filename,
            $image->getClientMimeType(), $path, true);
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

        return $this->createFile($filename,
            $upload->getClientMimeType(), $path, true);
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
     * @return void
     */
    public function renamePortalLogo(Portal $portal): void
    {
        $directory = 'profile-pictures';
        $newFileName = "{$portal->name}.jpg";

        foreach (['jpg', 'png'] as $extension) {
            $oldPath = "{$directory}/{$portal->name}.{$extension}";

            if (!Storage::disk('public')->exists($oldPath)) {
                continue;
            }

            Storage::disk('public')->move(
                $oldPath,
                "{$directory}/{$newFileName}"
            );

            File::where('filename', basename($oldPath))
                ->update(['filename' => $newFileName]);

            break;
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

    /**
     * Create a file record in the database
     * @param string $filename
     * @param string $mimeType
     * @param string $path
     * @param bool $visibility
     * @return File|string
     */
    private function createFile(string $filename, string $mimeType, string $path, bool $visibility): File| string
    {
        try {
            $file = File::create([
                'filename' => $filename,
                'mime_type' => $mimeType,
                'path' => $path,
                'visibility' => $visibility,
            ]);
        }
        catch (Exception $exception){
            return $exception->getMessage();
        }

        return $file;
    }
}
