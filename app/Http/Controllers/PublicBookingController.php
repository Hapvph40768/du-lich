<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Booking;
use App\Models\TourSchedule;
use App\Models\Coupon;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PublicBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('bookings.my', compact('bookings'));
    }

    public function store(Request $request, $tour_id)
    {
        $tour = Tour::findOrFail($tour_id);

        $validated = $request->validate([
            'tickets' => 'required|integer|min:1',
            'note' => 'nullable|string',
            'coupon_code' => 'nullable|string',
            'payment_method' => 'required|in:vnpay,momo,bank_transfer,cash'
        ]);

        if ($tour->max_people !== null && $tour->max_people > 0) {
            if ($validated['tickets'] > $tour->max_people) {
                return back()->with('error', 'Không đủ số chỗ trống.');
            }
        }

        $schedule = TourSchedule::firstOrCreate(
            ['tour_id' => $tour->id, 'status' => 'scheduled'],
            [
                'departure_date' => now()->addDays(7),
                'return_date' => now()->addDays(7 + ($tour->duration_days ?? 1))
            ]
        );

        $base_price = $tour->price * $validated['tickets'];
        $discount_amount = 0;
        $note_append = '';

        if (!empty($validated['coupon_code'])) {
            $coupon = Coupon::where('code', strtoupper($validated['coupon_code']))
                ->where('status', 'active')
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();

            if ($coupon) {
                $discount_amount = ($base_price * $coupon->discount_percent) / 100;
                if ($coupon->max_discount && $discount_amount > $coupon->max_discount) {
                    $discount_amount = $coupon->max_discount;
                }
                $note_append = " (Đã áp dụng mã: {$coupon->code} - Giảm $" . number_format($discount_amount, 2) . ")";
            } else {
                return back()->with('error', 'Mã giảm giá không hợp lệ hoặc đã hết hạn.');
            }
        }

        $total_price = $base_price - $discount_amount;
        $final_note = $validated['note'] . $note_append;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $schedule->id,
            'total_price' => max(0, $total_price),
            'status' => 'pending',
            'note' => $final_note
        ]);

        Payment::create([
            'booking_id' => $booking->id,
            'amount' => max(0, $total_price),
            'payment_method' => $validated['payment_method'],
            'status' => 'pending'
        ]);

        return back()->with('success', 'Đặt Tour thành công! Hãy kiểm tra thông tin thanh toán.');
    }
}
