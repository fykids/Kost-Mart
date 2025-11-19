<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class OrderList extends Component
{
    use WithPagination;

    #[Url]
    public $status = '';

    public $totalOrders = 0;
    public $stats = [];

    /**
     * Mount
     */
    public function mount()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->calculateStats();
    }

    /**
     * Calculate order statistics
     */
    public function calculateStats()
    {
        // Use a single grouped query to reduce multiple count queries
        $counts = auth()->user()->orders()
            ->selectRaw('status, count(*) as cnt')
            ->groupBy('status')
            ->pluck('cnt', 'status')
            ->toArray();

        $total = array_sum($counts);

        $this->stats = [
            'total' => $total,
            'pending' => $counts['pending'] ?? 0,
            'paid' => $counts['paid'] ?? 0,
            'shipped' => $counts['shipped'] ?? 0,
            'delivered' => $counts['delivered'] ?? 0,
            'cancelled' => $counts['cancelled'] ?? 0,
        ];
    }

    /**
     * Update status filter
     */
    public function updatingStatus()
    {
        $this->resetPage();
    }

    /**
     * Cancel order
     */
    public function cancelOrder($orderId)
    {
        $order = Order::find($orderId);

        if (!$order || $order->user_id !== auth()->id()) {
            $this->dispatch('swal:error', message: 'Pesanan tidak ditemukan');
            return;
        }

        if (!in_array($order->status, ['pending', 'paid'])) {
            $this->dispatch('swal:error', message: 'Pesanan tidak dapat dibatalkan');
            return;
        }

        // Restore product stock (ensure items and products are loaded)
        $order->loadMissing('items.product');
        foreach ($order->items as $item) {
            $item->product->increment('stock', $item->quantity);
        }

        $order->update(['status' => 'cancelled']);
        $this->dispatch('swal:success', message: 'Pesanan dibatalkan!');
        $this->calculateStats();
    }

    /**
     * Mark as paid
     */
    public function markAsPaid($orderId)
    {
        $order = Order::find($orderId);

        if (!$order || $order->user_id !== auth()->id()) {
            $this->dispatch('swal:error', message: 'Pesanan tidak ditemukan');
            return;
        }

        if ($order->status !== 'pending') {
            $this->dispatch('swal:error', message: 'Status pesanan tidak sesuai');
            return;
        }

        $order->update(['status' => 'paid']);
        $this->dispatch('swal:success', message: 'Pesanan telah dibayar!');
        $this->calculateStats();
    }

    public function render()
    {
        $query = auth()->user()->orders()->with('items.product');

        // Filter by status
        if ($this->status) {
            $query->where('status', $this->status);
        }

        $orders = $query->latest()->paginate(10);
        $this->totalOrders = auth()->user()->orders()->count();

        return view('livewire.order-list', [
            'orders' => $orders,
            'stats' => $this->stats,
            'totalOrders' => $this->totalOrders,
        ]);
    }
}
