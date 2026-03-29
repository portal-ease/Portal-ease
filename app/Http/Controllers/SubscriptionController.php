<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portal;
use Stripe\Stripe;
use Stripe\Subscription;

class SubscriptionController extends Controller
{
    public function cancel($portalId)
    {
        $portal = Portal::findOrFail($portalId);

        if (!$portal->stripe_subscription_id) {
            return redirect()->back()->with('error', 'Geen actief abonnement gevonden.');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Abonnement laten aflopen aan het einde van de huidige periode
            $subscription = Subscription::update(
                $portal->stripe_subscription_id,
                ['cancel_at_period_end' => true]
            );

            $portal->update([
                'subscription_status' => 'inactive',
                'subscription_end_date' => date('Y-m-d H:i:s', $subscription->current_period_end),
            ]);

            return redirect()->back()->with('success', 'Abonnement wordt beëindigd aan het einde van de huidige periode.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Stripe-fout: ' . $e->getMessage());
        }
    }
}
