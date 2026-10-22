<?php

use App\Models\Portal;
use App\Models\PortalFeature;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $portals = Portal::all();

        DB::transaction(function () use ($portals) {
            foreach ($portals as $portal) {
                $feature = PortalFeature::query()
                    ->where('portal_id', $portal->id)
                    ->where('feature', 'document_sharing')->first();
                $feature->update(['feature' => 'document_hub']);
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
