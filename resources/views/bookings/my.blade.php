@extends('layouts.app')

@section('title', 'Lịch Sử Đặt Tour')

@section('content')
<div style="background: var(--primary-color); padding: 4rem 2rem 2rem; color: white; text-align: center; margin-bottom: 3rem;">
    <h1 style="font-size: 2.5rem; font-weight: 700;">Nhật Ký Chuyến Đi Của Tôi</h1>
</div>

<div style="max-width: 1000px; margin: 0 auto; padding: 0 20px 5rem;">
    @forelse($bookings as $booking)
        <div style="background: white; border-radius: 15px; padding: 2rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 0.85rem; color: #6b7280; margin-bottom: 0.5rem;">Mã Đơn #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }} &bull; {{ $booking->created_at->format('d/m/Y') }}</div>
                <h3 style="font-size: 1.25rem; margin: 0 0 0.5rem; color: #1f2937;">{{ $booking->schedule->tour->name ?? 'Tour Không Xác Định' }}</h3>
                <div style="color: #4b5563; font-weight: 500;">
                    ${{ number_format($booking->total_price, 2) }} 
                    <span style="display:inline-block; margin-left: 1rem; padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.75rem; 
                    @if($booking->status == 'pending') background:#fef3c7; color:#92400e; 
                    @elseif($booking->status == 'confirmed') background:#dbeafe; color:#1e40af;
                    @else background:#d1e7dd; color:#0f5132; @endif">
                    {{ ucfirst($booking->status) }}
                    </span>
                </div>
            </div>
            <div>
                <a href="{{ route('tours.show', $booking->schedule->tour_id ?? 0) }}" style="color: var(--primary-color); font-weight: 600; text-decoration: none;">Xem Tour &rarr;</a>
            </div>
        </div>
    @empty
        <div style="text-align: center; padding: 4rem; background: white; border-radius: 20px;">
            <div style="font-size: 3rem; margin-bottom: 1rem;">✈️</div>
            <h2 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 1rem;">Bạn chưa đặt tour nào.</h2>
            <p style="color: #6b7280; margin-bottom: 2rem;">Hãy bắt đầu khám phá những điểm đến tuyệt vời của chúng tôi!</p>
            <a href="/#tours" class="btn">Tìm Hành Trình</a>
        </div>
    @endforelse
</div>
@endsection
