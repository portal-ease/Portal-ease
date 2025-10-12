<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function callback(Request $request)
    {
        if ($request->has('canceled')) {
            return view('stripe.cancel');
        }

        return view('stripe.success');
    }
}
