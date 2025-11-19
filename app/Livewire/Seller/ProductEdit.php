<?php

namespace App\Livewire\Seller;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Locked;

class ProductEdit extends Component
{
    #[Locked]
    public $productId;

    public $name = '';
    public $description = '';
    public $price = '';
    public $stock = '';
    public $category_id = '';
    public $image = '';
    public $is_active = true;
    public $categories = [];
    public $product;

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->product = Product::findOrFail($productId);

        // Verify ownership
        if ($this->product->user_id !== auth()->id() || auth()->user()->role !== 'seller') {
            return redirect()->route('seller.products.index');
        }

        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->stock = $this->product->stock;
        $this->category_id = $this->product->category_id;
        $this->image = $this->product->image;
        $this->is_active = $this->product->is_active;

        $this->categories = Category::all();
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

    public function updateProduct()
    {
        $validated = $this->validate();

        $this->product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'category_id' => $validated['category_id'],
            'image' => $validated['image'],
            'is_active' => $this->is_active,
        ]);

        $this->dispatch('swal:success', message: 'Produk berhasil diperbarui!');
        return redirect()->route('seller.products.index');
    }

    public function render()
    {
        return view('livewire.seller.product-edit', [
            'categories' => $this->categories,
        ]);
    }
}
