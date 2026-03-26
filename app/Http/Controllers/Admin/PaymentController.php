<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking.user', 'booking.schedule.tour')
            ->latest()
            ->paginate(15);
        
        return view('admin.payments.index', compact('payments'));
    }

    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,success,failed,refunded',
            'transaction_id' => 'nullable|string|max:255',
        ]);

        if ($validated['status'] === 'success' && $payment->status !== 'success') {
            $payment->paid_at = now();
            // Automatically update booking status if payment is successful
            $payment->booking->update(['status' => 'paid']);
        }

        $payment->update($validated);

        return redirect()->route('admin.payments.index')->with('success', 'Cập nhật trạng thái thanh toán thành công!');
    }
}
