<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Checkout extends Component
{
    public $shippingAddress;
    public $paymentMethod = 'cod';
    public $notes = '';
    public $cartItems;
    public $total = 0;
    public $isProcessing = false;

    public function mount()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->loadCartItems();

        if ($this->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('warning', 'Keranjang belanja kosong');
        }
    }

    /**
     * Load cart items
     */
    public function loadCartItems()
    {
        $this->cartItems = auth()->user()->carts()->with('product')->get();
        $this->calculateTotal();
    }

    /**
     * Calculate total
     */
    public function calculateTotal()
    {
        $this->total = $this->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

    /**
     * Validate checkout
     */
    public function rules()
    {
        return [
            'shippingAddress' => 'required|min:10|max:500',
            'paymentMethod' => ['required', Rule::in(['cod', 'transfer', 'e_wallet'])],
            'notes' => 'nullable|max:500',
        ];
    }

    /**
     * Get validation messages
     */
    public function messages()
    {
        return [
            'shippingAddress.required' => 'Alamat pengiriman wajib diisi',
            'shippingAddress.min' => 'Alamat minimal 10 karakter',
            'paymentMethod.required' => 'Pilih metode pembayaran',
        ];
    }

    /**
     * Process checkout
     */
    public function processCheckout()
    {
        $this->validate();

        $this->isProcessing = true;

        try {
            // Validate stock before processing
            foreach ($this->cartItems as $item) {
                if ($item->quantity > $item->product->stock) {
                    throw new \Exception("Stok {$item->product->name} tidak cukup");
                }
            }

            // Generate order number
            $orderNumber = 'ORD-' . date('Ymd') . '-' . str_pad(
                Order::whereDate('created_at', today())->count() + 1,
                3,
                '0',
                STR_PAD_LEFT
            );

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => $orderNumber,
                'total_price' => $this->total,
                'status' => 'pending',
                'payment_method' => $this->paymentMethod,
                'shipping_address' => $this->shippingAddress,
                'notes' => $this->notes ?: null,
            ]);

            // Create order items and update stock
            foreach ($this->cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'subtotal' => $item->product->price * $item->quantity,
                ]);

                // Update product stock
                $item->product->decrement('stock', $item->quantity);
            }

            // Clear cart
            auth()->user()->carts()->delete();

            // Redirect based on payment method
            if ($this->paymentMethod === 'transfer') {
                return redirect()->route('payment.transfer', $order->id);
            }

            if ($this->paymentMethod === 'e_wallet') {
                return redirect()->route('payment.e_wallet', $order->id);
            }

            $this->dispatch('swal:success', message: 'Pesanan berhasil dibuat!');
            return redirect()->route('orders.show', $order->id);

        } catch (\Exception $e) {
            $this->dispatch('swal:error', message: $e->getMessage());
            $this->isProcessing = false;
            return;
        }
    }

    public function render()
    {
        return view('livewire.checkout', [
            'cartItems' => $this->cartItems,
            'total' => $this->total,
        ]);
    }
}
