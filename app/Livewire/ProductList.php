<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    #[Url]
    public $category = '';

    #[Url]
    public $sort = 'latest';

    public $totalProducts = 0;
    public $categories = [];

    public function mount()
    {
        // Cache categories for 60 minutes to reduce repeated DB hits
        $this->categories = cache()->remember('categories_all', 60 * 60, function () {
            return Category::all();
        });
    }

    /**
     * Update search
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Update category filter
     */
    public function updatingCategory()
    {
        $this->resetPage();
    }

    /**
     * Clear semua filter
     */
    public function clearFilters()
    {
        $this->search = '';
        $this->category = '';
        $this->sort = 'latest';
        $this->resetPage();
        $this->dispatch('filters-cleared');
    }

    /**
     * Get product count
     */
    public function getProductCountProperty()
    {
        $query = Product::where('is_active', true);

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        }

        if ($this->category) {
            $query->where('category_id', $this->category);
        }

        return $query->count();
    }

    public function render()
    {
        $query = Product::where('is_active', true);

        // Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Category filter
        if ($this->category) {
            $query->where('category_id', $this->category);
        }

        // Sorting
        match($this->sort) {
            'popular' => $query->orderBy('stock', 'desc'),
            'price_low' => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            default => $query->orderBy('created_at', 'desc'),
        };

        // Eager-load relations commonly used in views to avoid N+1
        $products = $query->with('category')->paginate(12);
        $this->totalProducts = $this->getProductCountProperty();

        return view('livewire.product-list', [
            'products' => $products,
            'categories' => $this->categories,
            'totalProducts' => $this->totalProducts,
        ]);
    }
}
