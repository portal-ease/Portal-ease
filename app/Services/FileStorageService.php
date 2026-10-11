<?php

namespace App\Services;

use App\Models\File;
use App\Models\Portal;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileStorageService
{
    /**
     * Store a document in the storage
     */
    public function storeDocument(UploadedFile $upload, bool $visibility): File|string
    {
        $disk = config('filesystems.default');
        $path = $upload->store('files', $disk);

        return $this->createFile($upload->getClientOriginalName(),
            $upload->getClientMimeType(), $path, $visibility, $disk);
    }

    /**
     * Store a portal logo in the service
     */
    public function storePortalLogo(UploadedFile $image, string $portalName): void
    {
        $disk = config('filesystems.default');

        $filename = $portalName.'.'.$image->getClientOriginalExtension();
        $path = $image->storeAs('profile-pictures', $filename, $disk);

        $this->createFile($filename, $image->getClientMimeType(), $path, true, $disk);
    }

    /**
     * Store a user logo in the service
     */
    public function storeUserProfilePicture(User $user, UploadedFile $upload): File|string
    {
        $disk = config('filesystems.default');

        $filename = $user->name.$user->id.'.'.$upload->getClientOriginalExtension();
        $path = $upload->storeAs('profile-pictures', $filename, $disk);

        return $this->createFile($filename,
            $upload->getClientMimeType(), $path, true, $disk);
    }

    /**
     * Download a file or image
     */
    public function download(File $file): StreamedResponse
    {
        return Storage::disk($file->disk)->download($file->path, $file->filename);
    }

    /**
     * Find the logo url of the given portal
     */
    public function portalLogoUrl(Portal $portal): ?string
    {
        foreach (['jpg', 'png', 'jpeg'] as $extension) {
            $path = "profile-pictures/{$portal->name}.{$extension}";

            $disk = config('filesystems.default');

            if (Storage::disk($disk)->exists($path)) {
                return Storage::disk($disk)->url($path);
            }
        }

        return null;
    }

    /**
     * Find the logo url of the given user
     */
    public function userProfilePicture(User $user): ?string
    {
        foreach (['jpg', 'png', 'jpeg'] as $extension) {
            $path = "profile-pictures/{$user->name}{$user->id}.{$extension}";

            $disk = config('filesystems.default');

            if (Storage::disk($disk)->exists($path)) {
                return Storage::disk($disk)->url($path);
            }
        }

        return null;
    }

    /**
     * Rename the portal logo
     */
    public function renamePortalLogo(string $oldPortalName, string $newPortalName): void
    {
        $disk = config('filesystems.default');
        $directory = 'profile-pictures';

        foreach (['jpg', 'png', 'jpeg'] as $extension) {
            $oldPath = "{$directory}/{$oldPortalName}.{$extension}";

            if (! Storage::disk($disk)->exists($oldPath)) {
                continue;
            }

            $newFileName = "{$newPortalName}.{$extension}";
            $newPath = "{$directory}/{$newFileName}";

            Storage::disk($disk)->move($oldPath, $newPath);

            File::where('filename', basename($oldPath))
                ->update([
                    'filename' => $newFileName,
                    'path' => $newPath,
                ]);

            break;
        }
    }

    /**
     * Delete a file from the storage and database
     */
    public function delete(File $file): void
    {
        Storage::disk($file->disk)->delete($file->path);

        $file->delete();
    }

    /**
     * Create a file record in the database
     */
    private function createFile(string $filename, string $mimeType, string $path, bool $visibility, string $disk): File
    {
        return File::create([
            'filename' => $filename,
            'mime_type' => $mimeType,
            'path' => $path,
            'visibility' => $visibility,
            'disk' => $disk,
        ]);
    }
}
