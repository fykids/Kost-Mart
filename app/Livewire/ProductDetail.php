<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Cart as CartModel;
use App\Models\Review;
use Livewire\Component;
use Livewire\Attributes\Locked;

class ProductDetail extends Component
{
    #[Locked]
    public $productId;

    public $quantity = 1;
    public $product;
    public $reviews;
    public $avgRating = 0;

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->product = Product::findOrFail($productId);
        $this->loadReviews();
    }

    /**
     * Load reviews and rating
     */
    public function loadReviews()
    {
        $this->reviews = $this->product->reviews()->with('user')->latest()->get();
        $this->avgRating = $this->reviews->avg('rating') ?? 0;
    }

    /**
     * Increase quantity
     */
    public function increaseQuantity()
    {
        if ($this->quantity < $this->product->stock) {
            $this->quantity++;
        } else {
            $this->dispatch('swal:warning', message: 'Stok tidak cukup');
        }
    }

    /**
     * Decrease quantity
     */
    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    /**
     * Add to cart
     */
    public function addToCart()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Check stock
        if ($this->quantity > $this->product->stock) {
            $this->dispatch('swal:error', message: 'Stok tidak cukup');
            return;
        }

        $existingCart = CartModel::where('user_id', auth()->id())
                                  ->where('product_id', $this->product->id)
                                  ->first();

        if ($existingCart) {
            $newQuantity = $existingCart->quantity + $this->quantity;
            
                if ($newQuantity > $this->product->stock) {
                $this->dispatch('swal:error', message: 'Total stok tidak cukup');
                return;
            }

            $existingCart->update(['quantity' => $newQuantity]);
        } else {
            CartModel::create([
                'user_id' => auth()->id(),
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
            ]);
        }

        $this->dispatch('swal:success', message: 'Produk ditambahkan ke keranjang!');
        $this->dispatch('cart-updated');
        $this->quantity = 1;
    }

    /**
     * Get star rating
     */
    public function getStarRating()
    {
        return round($this->avgRating);
    }

    /**
     * Get review count by rating
     */
    public function getReviewsByRating($rating)
    {
        return $this->reviews->where('rating', $rating)->count();
    }

    public function render()
    {
        return view('livewire.product-detail', [
            'product' => $this->product,
            'reviews' => $this->reviews,
            'avgRating' => $this->avgRating,
            'starRating' => $this->getStarRating(),
        ]);
    }
}
