<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Portal;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (\Exception $e) {
            Log::error("Stripe webhook error: " . $e->getMessage());
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                $email = $session->customer_details->email;
                $portal = Portal::where('admin_email', $email)->first();

                if ($portal) {
                    $portal->stripe_customer_id = $session->customer;
                    $portal->stripe_subscription_id = $session->subscription;
                    $portal->subscription_status = 'active';
                    $portal->save();

                    Log::info("Subscription gekoppeld aan portal: {$portal->id}");
                } else {
                    Log::warning("Geen portal gevonden voor email: " . $email);
                }
                break;

            case 'customer.subscription.deleted':
                $subscription = $event->data->object;
                $portal = Portal::where('stripe_subscription_id', $subscription->id)->first();

                if ($portal) {
                    $portal->subscription_status = 'canceled';
                    $portal->subscription_end_date = now();
                    $portal->save();

                    Log::info("Subscription beëindigd voor portal: {$portal->id}");
                }
                break;
        }

        return response()->json(['status' => 'success']);
    }
}
