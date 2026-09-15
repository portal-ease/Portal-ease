<?php

namespace App\Services;

use App\Models\Portal;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PortalService
{
    public function __construct(
        private FileStorageService $storageService,
    ){}

    public function create(array $data, UploadedFile $logo)
    {
        return DB::transaction(function () use ($data, $logo) {
            $portal = Portal::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'branding_color' => $data['branding_color'],
            ]);

            $user = User::create([
                'name' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'portal_id' => $portal->id,
            ]);

            $this->storageService->storePortalLogo($logo, $portal->name);

            $user->assignRole('service_provider');
            $user->assignRole('admin');

            Auth::login($user);

            return $portal;
        });
    }

    public function update(Portal $portal, array $data, ?UploadedFile $logo = null){
        $oldName = $portal->name;

        $portal->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'branding_color' => $data['branding_color'],
        ]);

        if ($logo) {
            $this->storageService->storePortalLogo(
                $logo,
                $data['name'],
            );
        }

        if ($oldName !== $data['name']) {
            $this->storageService->renamePortalLogo(
                $oldName,
                $data['name'],
            );
        }

        return $portal;
    }
}
