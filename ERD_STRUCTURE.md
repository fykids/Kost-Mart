# Struktur Tabel ERD - E-Commerce untuk Anak Kost (Sederhana)

## 1. USERS (Pengguna)
```
users
├── id (INT, PK)
├── name (VARCHAR 255)
├── email (VARCHAR 255, UNIQUE)
├── password (VARCHAR 255)
├── phone (VARCHAR 15, nullable)
├── role (ENUM: 'customer', 'seller')
├── created_at (TIMESTAMP)
└── updated_at (TIMESTAMP)
```

## 2. CATEGORIES (Kategori Produk)
```
categories
├── id (INT, PK)
├── name (VARCHAR 100)
├── description (TEXT, nullable)
├── created_at (TIMESTAMP)
└── updated_at (TIMESTAMP)
```

## 3. PRODUCTS (Produk)
```
products
├── id (INT, PK)
├── user_id (INT, FK -> users.id) [Penjual]
├── category_id (INT, FK -> categories.id)
├── name (VARCHAR 255)
├── description (TEXT)
├── price (DECIMAL 12,2)
├── stock (INT)
├── image (VARCHAR 255, nullable)
├── is_active (BOOLEAN, default: true)
├── created_at (TIMESTAMP)
└── updated_at (TIMESTAMP)
```

## 4. CARTS (Keranjang Belanja)
```
carts
├── id (INT, PK)
├── user_id (INT, FK -> users.id)
├── product_id (INT, FK -> products.id)
├── quantity (INT)
├── created_at (TIMESTAMP)
└── updated_at (TIMESTAMP)
```

## 5. ORDERS (Pesanan)
```
orders
├── id (INT, PK)
├── user_id (INT, FK -> users.id) [Pembeli]
├── order_number (VARCHAR 50, UNIQUE)
├── total_price (DECIMAL 12,2)
├── status (ENUM: 'pending', 'paid', 'shipped', 'delivered', 'cancelled')
├── payment_method (ENUM: 'cod', 'transfer', 'e_wallet')
├── shipping_address (TEXT)
├── notes (TEXT, nullable)
├── created_at (TIMESTAMP)
└── updated_at (TIMESTAMP)
```

## 6. ORDER_ITEMS (Detail Item Pesanan)
```
order_items
├── id (INT, PK)
├── order_id (INT, FK -> orders.id)
├── product_id (INT, FK -> products.id)
├── quantity (INT)
├── price (DECIMAL 12,2)
├── subtotal (DECIMAL 12,2)
├── created_at (TIMESTAMP)
└── updated_at (TIMESTAMP)
```

## 7. REVIEWS (Ulasan Produk)
```
reviews
├── id (INT, PK)
├── product_id (INT, FK -> products.id)
├── user_id (INT, FK -> users.id)
├── rating (INT, 1-5)
├── comment (TEXT, nullable)
├── created_at (TIMESTAMP)
└── updated_at (TIMESTAMP)
```

## Relasi Antar Tabel

```
USERS (1) ──→ (many) PRODUCTS [Sebagai Seller]
      ──→ (many) CARTS [Sebagai Buyer]
      ──→ (many) ORDERS [Sebagai Buyer]
      ──→ (many) REVIEWS

CATEGORIES (1) ──→ (many) PRODUCTS

PRODUCTS (1) ──→ (many) CARTS
         ──→ (many) ORDER_ITEMS
         ──→ (many) REVIEWS

ORDERS (1) ──→ (many) ORDER_ITEMS

ORDER_ITEMS (many) ──→ (1) PRODUCTS
```

## Keterangan Fitur

- **Role User**: Satu user bisa menjadi buyer dan seller sekaligus
- **Kategori**: Makanan, Minuman, Perlengkapan, Elektronik, Gaya Hidup, dll
- **Status Pesanan**: Pending → Paid → Shipped → Delivered
- **Pembayaran**: COD (Cash on Delivery), Transfer Bank, E-Wallet
- **Review**: User bisa memberikan rating dan komentar setelah membeli

