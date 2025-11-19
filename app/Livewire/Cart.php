<?php

namespace App\Livewire;

use App\Models\Cart as CartModel;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems;
    public $total = 0;

    /**
     * Listeners
     */
    protected $listeners = ['cart-updated' => 'refreshCart'];

    public function mount()
    {
        $this->refreshCart();
    }

    /**
     * Get cart items for user
     */
    public function refreshCart()
    {
        if (!auth()->check()) {
            $this->cartItems = collect();
            $this->total = 0;
            return;
        }

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
     * Update quantity
     */
    public function updateQuantity($cartId, $quantity)
    {
        if (!auth()->check()) {
            return;
        }

        $cart = CartModel::find($cartId);
        
        if (!$cart || $cart->user_id !== auth()->id()) {
            return;
        }

        if ($quantity <= 0) {
            $cart->delete();
            $this->dispatch('swal:success', message: 'Item dihapus dari keranjang');
        } else if ($quantity > $cart->product->stock) {
            $this->dispatch('swal:error', message: 'Stok tidak cukup');
            return;
        } else {
            $cart->update(['quantity' => $quantity]);
            $this->dispatch('swal:success', message: 'Keranjang diperbarui');
        }

        $this->refreshCart();
        $this->dispatch('cart-updated');
    }

    /**
     * Remove item from cart
     */
    public function removeItem($cartId)
    {
        if (!auth()->check()) {
            return;
        }

        $cart = CartModel::find($cartId);
        
        if ($cart && $cart->user_id === auth()->id()) {
            $cart->delete();
            $this->dispatch('swal:success', message: 'Item dihapus dari keranjang');
        }

        $this->refreshCart();
        $this->dispatch('cart-updated');
    }

    /**
     * Clear all cart
     */
    public function clearCart()
    {
        if (auth()->check()) {
            auth()->user()->carts()->delete();
            $this->dispatch('swal:success', message: 'Keranjang dikosongkan');
        }
        
        $this->refreshCart();
        $this->dispatch('cart-updated');
    }

    /**
     * Get item count
     */
    public function getItemCountProperty()
    {
        return $this->cartItems->sum('quantity');
    }

    public function render()
    {
        return view('livewire.cart', [
            'cartItems' => $this->cartItems,
            'total' => $this->total,
            'itemCount' => $this->getItemCountProperty(),
        ]);
    }
}
