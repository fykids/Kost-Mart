<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController
{
    /**
     * Show bank transfer instructions
     */
    public function transfer($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Authorization: only owner can view
        if (auth()->id() !== $order->user_id) {
            abort(403);
        }

        // Generate a pseudo VA number (not stored)
        $va = 'VA' . str_pad($order->id, 8, '0', STR_PAD_LEFT);

        return view('payment.transfer', [
            'order' => $order,
            'bank' => 'Bank Contoh',
            'va' => $va,
            'amount' => $order->total_price,
        ]);
    }

    /**
     * Show e-wallet payment simulation
     */
    public function eWallet($orderId)
    {
        $order = Order::findOrFail($orderId);

        if (auth()->id() !== $order->user_id) {
            abort(403);
        }

        // Simulated payment payload
        $qrCodePayload = 'e-wallet://pay?order=' . $order->order_number . '&amount=' . $order->total_price;

        return view('payment.e_wallet', [
            'order' => $order,
            'qr' => $qrCodePayload,
            'amount' => $order->total_price,
        ]);
    }

    /**
     * Confirm payment (called by both transfer and e-wallet flows)
     */
    public function confirmPayment(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        if (auth()->id() !== $order->user_id) {
            abort(403);
        }

        if ($order->status === 'cancelled' || $order->status === 'delivered') {
            return redirect()->route('orders.show', $order->id)->with('error', 'Pesanan tidak dapat diproses pembayarannya.');
        }

        // Mark order as paid
        $order->status = 'paid';
        $order->save();

        return redirect()->route('orders.show', $order->id)->with('success', 'Pembayaran telah dikonfirmasi. Terima kasih!');
    }
}
