<?php

namespace App\Livewire\Seller;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Locked;

class ProductCreate extends Component
{
    #[Locked]
    public $userId;

    public $name = '';
    public $description = '';
    public $price = '';
    public $stock = '';
    public $category_id = '';
    public $image = '';
    public $is_active = true;
    public $categories = [];

    public function mount()
    {
        if (!auth()->check() || auth()->user()->role !== 'seller') {
            return redirect()->route('products.index');
        }

        $this->userId = auth()->id();
        $this->categories = Category::orderBy('name')->get();
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:1000',
            'stock' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|url',
            'is_active' => 'boolean',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Nama produk wajib diisi',
            'description.required' => 'Deskripsi wajib diisi dan minimal 10 karakter',
            'price.required' => 'Harga wajib diisi minimal Rp 1.000',
            'stock.required' => 'Stok wajib diisi minimal 1',
            'category_id.required' => 'Kategori wajib dipilih',
            'image.required' => 'URL gambar wajib diisi',
            'image.url' => 'URL gambar harus format URL yang valid',
        ];
    }

    public function createProduct()
    {
        $validated = $this->validate();

        Product::create([
            'user_id' => $this->userId,
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'category_id' => $validated['category_id'],
            'image' => $validated['image'],
            'is_active' => $this->is_active,
        ]);

        $this->dispatch('swal:success', message: 'Produk berhasil ditambahkan!');
        return redirect()->route('seller.products.index');
    }

    public function render()
    {
        return view('livewire.seller.product-create', [
            'categories' => $this->categories,
        ]);
    }
}
