<?php

namespace App\Livewire\Seller;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setSortBy($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function deleteProduct($productId)
    {
        $product = Product::findOrFail($productId);

        // Verify ownership
        if ($product->user_id !== auth()->id()) {
            $this->dispatch('swal:error', message: 'Tidak diizinkan menghapus produk ini');
            return;
        }

        // Check if product is in any active orders
        $activeOrders = $product->orderItems()
            ->whereHas('order', fn($q) => $q->whereIn('status', ['pending', 'paid', 'shipped']))
            ->count();

        if ($activeOrders > 0) {
            $this->dispatch('swal:error', message: 'Produk tidak dapat dihapus karena masih ada pesanan aktif');
            return;
        }

        $product->delete();
        $this->dispatch('swal:success', message: 'Produk berhasil dihapus');
    }

    public function toggleActive($productId)
    {
        $product = Product::findOrFail($productId);

        // Verify ownership
        if ($product->user_id !== auth()->id()) {
            $this->dispatch('swal:error', message: 'Tidak diizinkan mengubah produk ini');
            return;
        }

        $product->update(['is_active' => !$product->is_active]);
        
        $message = $product->is_active ? 'Produk diaktifkan' : 'Produk dinonaktifkan';
        $this->dispatch('swal:success', message: $message);
    }

    public function render()
    {
        $products = auth()->user()
            ->products()
            ->where(function ($q) {
                if ($this->search) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
                }
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.seller.product-list', [
            'products' => $products,
        ]);
    }
}
