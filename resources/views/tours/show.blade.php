@extends('layouts.app')

@section('title', $tour->name)

@section('content')
<div class="hero" style="height: 50vh; background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=2000&q=80');">
    <div>
        <h1 style="font-size: 3rem;">{{ $tour->name }}</h1>
        <p style="font-size: 1.2rem; color: #f3f4f6;">{{ $tour->location->name ?? 'Quốc tế' }} &bull; {{ $tour->category->name ?? 'Mạo hiểm' }}</p>
    </div>
</div>

<div style="max-width: 1200px; margin: -50px auto 4rem; padding: 0 20px; position: relative; z-index: 10;">
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
        
        <!-- Left Column: Details -->
        <div style="background: white; padding: 2.5rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
            <h2 style="font-size: 1.8rem; font-weight: 700; color: #1f2937; margin-bottom: 1rem;">Tổng Quan Chuyến Đi</h2>
            
            <div style="display: flex; gap: 2rem; margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 1px solid #e5e7eb;">
                <div>
                    <span style="color: #6b7280; font-size: 0.9rem; display: block;">Thời lượng</span>
                    <strong style="color: #111827; font-size: 1.1rem;">{{ $tour->duration_days }} Ngày, {{ $tour->duration_nights }} Đêm</strong>
                </div>
                <div>
                    <span style="color: #6b7280; font-size: 0.9rem; display: block;">Số lượng tối đa</span>
                    <strong style="color: #111827; font-size: 1.1rem;">{{ $tour->max_people ?: 'Không giới hạn' }}</strong>
                </div>
                <div>
                    <span style="color: #6b7280; font-size: 0.9rem; display: block;">Giá / người</span>
                    <strong style="color: var(--primary-color); font-size: 1.1rem;">${{ number_format($tour->price, 2) }}</strong>
                </div>
            </div>

            <div style="line-height: 1.7; color: #4b5563; font-size: 1.05rem;">
                {!! nl2br(e($tour->description)) !!}
            </div>
        </div>

        <!-- Right Column: Booking Widget -->
        <div style="background: white; padding: 2rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); height: fit-content; position: sticky; top: 100px;">
            <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem; color: #1f2937;">Đặt Tour Này</h3>
            
            @if(session('success'))
                <div style="background: #d1e7dd; color: #0f5132; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('bookings.store', $tour->id) }}" method="POST">
                @csrf
                
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.9rem;">Số vé / Hành khách</label>
                    <input type="number" name="tickets" min="1" max="{{ $tour->max_people ?: 100 }}" value="1" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 10px; box-sizing: border-box;" required>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.9rem;">Mã Giảm Giá (Tùy chọn)</label>
                    <input type="text" name="coupon_code" placeholder="Nhập mã nếu có..." style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 10px; box-sizing: border-box; text-transform: uppercase;">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.9rem;">Phương Thức Thanh Toán</label>
                    <select name="payment_method" class="form-control" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 10px; box-sizing: border-box;" required>
                        <option value="cash">Tiền mặt tại văn phòng</option>
                        <option value="bank_transfer">Chuyển khoản Ngân hàng</option>
                        <option value="vnpay">Thanh toán qua VNPay</option>
                        <option value="momo">Thanh toán qua Momo</option>
                    </select>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.9rem;">Ghi chú (Tùy chọn)</label>
                    <textarea name="note" rows="3" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 10px; box-sizing: border-box;"></textarea>
                </div>

                @auth
                    <button type="submit" style="width: 100%; background: var(--primary-color); color: white; border: none; padding: 1rem; border-radius: 10px; font-weight: 600; font-size: 1.1rem; cursor: pointer; transition: background 0.3s;">Xác Nhận Đặt Tour</button>
                @else
                    <a href="{{ route('login') }}" style="display: block; text-align: center; width: 100%; background: #e5e7eb; color: #4b5563; text-decoration: none; padding: 1rem; border-radius: 10px; font-weight: 600; font-size: 1.1rem; cursor: pointer; box-sizing: border-box;">Đăng nhập để Đặt</a>
                @endauth
            </form>
        </div>

    </div>
</div>
@endsection
