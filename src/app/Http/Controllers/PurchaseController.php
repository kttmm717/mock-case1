<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\SoldItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

class PurchaseController extends Controller
{
    public function index($item_id) {
        $item = Item::find($item_id);
        $user = User::find(Auth::id());
        return view('purchase', compact('item', 'user'));
    }

    public function purchase($item_id, Request $request) {
        $item = Item::find($item_id);
        $stripe = new StripeClient(config('stripe.stripe_secret_key'));

        [
            $user_id,
            $amount,
            $sending_postcode,
            $sending_address,
            $sending_building
        ] = [
            Auth::id(),
            $item->price,
            $request->sending_postcode,
            urlencode($request->sending_address),
            urlencode($request->sending_building) ?? null
        ];

        $checkout_session = $stripe->checkout->sessions->create([
            'payment_method_types' => [$request->payment_method],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => ['name' => $item->name],
                        'unit_amount' => $item->price,],

                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => "http://localhost/purchase/{$item_id}/success?user_id={$user_id}&amount={$amount}&sending_postcode={$sending_postcode}&sending_address={$sending_address}&sending_building={$sending_building}",
        ]);
        return redirect($checkout_session->url);
    }

    public function success($item_id, Request $request) {
        $stripe = new StripeClient(config('stripe.stripe_secret_key'));
        $stripe->charges->create([
            'amount' => $request->amount,
            'currency' => 'jpy',
            'source' => 'tok_visa'
        ]);
        SoldItem::create([
            'user_id' => $request->user_id,
            'item_id' => $item_id,
            'sending_postcode' => $request->sending_postcode,
            'sending_address' => $request->sending_address,
            'sending_building' => $request->sending_building
        ]);
        return redirect('/')->with('flashSuccess', '決済が完了しました！');
    }
} 
