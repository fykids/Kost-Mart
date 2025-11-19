<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Locked;

class OrderDetail extends Component
{
    #[Locked]
    public $orderId;

    public $order;
    public $canCancel = false;
    public $canPayment = false;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
        $this->order = Order::with('items.product', 'user')->findOrFail($orderId);

        // Pastikan user hanya bisa lihat order mereka sendiri
        if ($this->order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $this->checkOrderActions();
    }

    /**
     * Check what actions can be taken
     */
    public function checkOrderActions()
    {
        $this->canCancel = in_array($this->order->status, ['pending', 'paid']);
        $this->canPayment = $this->order->status === 'pending';
    }

    /**
     * Cancel order
     */
    public function cancelOrder()
    {
        if (!$this->canCancel) {
            $this->dispatch('swal:error', message: 'Pesanan tidak dapat dibatalkan');
            return;
        }

        try {
            // Restore product stock
            foreach ($this->order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }

            $this->order->update(['status' => 'cancelled']);
            $this->checkOrderActions();
            $this->dispatch('swal:success', message: 'Pesanan dibatalkan!');
        } catch (\Exception $e) {
            $this->dispatch('swal:error', message: 'Gagal membatalkan pesanan');
        }
    }

    /**
     * Mark as paid
     */
    public function markAsPaid()
    {
        if (!$this->canPayment) {
            $this->dispatch('swal:error', message: 'Pesanan tidak dapat ditandai sebagai dibayar');
            return;
        }

        try {
            $this->order->update(['status' => 'paid']);
            $this->checkOrderActions();
            $this->dispatch('swal:success', message: 'Pembayaran berhasil dicatat!');
        } catch (\Exception $e) {
            $this->dispatch('swal:error', message: 'Gagal memperbarui status pembayaran');
        }
    }

    /**
     * Get status color
     */
    public function getStatusColor()
    {
        return match($this->order->status) {
            'pending' => 'yellow',
            'paid' => 'blue',
            'shipped' => 'purple',
            'delivered' => 'green',
            'cancelled' => 'red',
            default => 'gray',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabel()
    {
        return match($this->order->status) {
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Dibayar',
            'shipped' => 'Dalam Pengiriman',
            'delivered' => 'Tiba',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($this->order->status),
        };
    }

    public function render()
    {
        return view('livewire.order-detail', [
            'order' => $this->order,
            'statusColor' => $this->getStatusColor(),
            'statusLabel' => $this->getStatusLabel(),
            'canCancel' => $this->canCancel,
            'canPayment' => $this->canPayment,
        ]);
    }
}
