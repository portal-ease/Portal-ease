<?php

use App\Models\Portal;
use App\Models\PortalFeature;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public const array FEATURES = [
        'projects',
        'invoices',
        'document_sharing',
        'conversations',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $portals = Portal::all();

        DB::transaction(function () use ($portals) {
            foreach ($portals as $portal) {
                foreach (self::FEATURES as $feature) {
                    PortalFeature::create([
                        'portal_id' => $portal->id,
                        'feature' => $feature,
                        'enabled' => true,
                    ]);
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
