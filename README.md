# KostMart — Mini Marketplace untuk Anak Kost

KostMart adalah aplikasi marketplace sederhana yang memudahkan anak kost untuk membeli dan menjual kebutuhan sehari-hari. Aplikasi ini mendukung dua peran pengguna: **Pembeli (Customer)** dan **Penjual (Seller)**.

---

## 📌 Fitur Utama

* **Browse & Search Produk**
* **Detail Produk & Review**
* **Keranjang & Checkout**
* **Pembayaran (COD / Transfer / E-Wallet)**
* **Manajemen Pesanan (Order Tracking)**
* **Seller Dashboard (CRUD Produk)**
* **Akun & Pengaturan Profil**

---

## 🧭 User Journey (Alur Lengkap)

### 👤 Visitor/Buyer Flow

1. **Browse Produk**

   * Route: `/`
   * Komponen: `ProductList`

2. **Lihat Detail Produk**

   * Route: `/products/{id}`
   * Komponen: `ProductDetail`

3. **Tambah ke Keranjang**

   * Update tabel `carts` dengan upsert

4. **Lihat Keranjang**

   * Route: `/cart`
   * Komponen: `Cart`

5. **Checkout (wajib login)**

   * Route: `/checkout`
   * Komponen: `Checkout`
   * Validasi alamat, metode pembayaran

6. **Pembuatan Pesanan (Order)**

   * Create `orders` (status: pending)
   * Create `order_items`
   * Update stock produk
   * Clear cart

7. **Pembayaran**

   * Transfer / E-Wallet disimulasikan lewat `PaymentController`
   * Status order berubah → **paid**

8. **Pengiriman & Penyelesaian**

   * Seller mengubah status → shipped
   * Buyer konfirmasi → delivered

9. **Pembatalan**

   * Allowed saat status pending / paid tertentu
   * Stok produk dikembalikan

---

## 🧑‍💼 Seller Flow (CRUD Produk)

1. **Dashboard Seller**

   * Route: `/seller/products`
   * Middleware: `auth + seller`

2. **Tambah Produk**

   * Route: `/seller/products/create`
   * Komponen: `Seller/ProductCreate`

3. **Edit Produk**

   * Route: `/seller/products/{id}/edit`
   * Komponen: `Seller/ProductEdit`
   * Validasi: hanya pemilik produk

4. **Hapus Produk**

   * Cek produk terlibat order aktif → tidak bisa dihapus

5. **Toggle Aktif/Nonaktif**

   * Sembunyikan produk dari listing buyer

---

## 🔄 Order Lifecycle

```
Guest -> Login -> Add to Cart -> Checkout -> Order Pending
   |                                          |
   |---- Payment (Transfer/E-Wallet) ---------|

Pending -> Paid -> Shipped -> Delivered
   \
    Cancelled (stock restored)
```

---

## 🗂️ Struktur Komponen Penting

### Livewire Components

* `ProductList`
* `ProductDetail`
* `Cart`
* `Checkout`
* `OrderList`
* `OrderDetail`
* `AccountSettings`
* `Seller/ProductCreate`
* `Seller/ProductEdit`
* `Seller/ProductList`

### Controllers

* `PaymentController`
* `AuthController`

### Routes

* `/products`
* `/products/{id}`
* `/cart`
* `/checkout`
* `/settings/account`
* `/seller/*` (dengan middleware seller)

---

## 🧪 Validasi & Edge Cases

* Tidak boleh menambah jumlah > stok tersedia
* Checkout gagal jika ada produk non-aktif
* Seller tidak dapat mengedit produk milik orang lain
* Produk tidak bisa dihapus jika digunakan di order aktif
* Pembatalan order mengembalikan stok

---

## 🔔 Events & UI Notifications

* `swal:success`
* `swal:error`
* `cart-updated`

Direkomendasikan memakai broadcast untuk notifikasi real-time.

---

## 📊 Logging & Monitoring

* Log: pembuatan produk, edit, delete, pembuatan order, pembayaran, cancel
* Metrics: jumlah order, AOV, conversion rate checkout
* Pertimbangkan audit trail untuk perubahan status order

---

## 🚀 Rencana Pengembangan Selanjutnya

* Diagram alur (Mermaid) untuk Buyer & Seller
* Sistem email notifikasi (order created, payment confirmed)
* Panel admin untuk melihat semua order
* Integration test untuk seluruh purchase flow & seller CRUD

---

## 📞 Kontak

Jika membutuhkan dokumentasi lanjutan atau optimasi arsitektur, silakan hubungi tim pengembang.

KostMart — *Marketplace sederhana, solusi lengkap untuk anak kost!*
