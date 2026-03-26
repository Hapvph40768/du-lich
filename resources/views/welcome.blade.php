@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
<div class="hero" style="position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center; text-align: center; color: white; padding: 0 20px; height: 85vh; background: linear-gradient(135deg, rgba(15,23,42,0.8) 0%, rgba(30,58,138,0.7) 100%), url('https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?ixlib=rb-4.0.3&auto=format&fit=crop&w=2021&q=80') center/cover;">
    <div style="position: relative; z-index: 10; animation: fadeInDown 1s ease-out;">
        <span style="display: inline-block; padding: 0.5rem 1.5rem; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 50px; font-weight: 600; font-size: 0.9rem; margin-bottom: 1.5rem; letter-spacing: 1px; text-transform: uppercase;">Cuộc phiêu lưu bắt đầu từ đây</span>
        <h1 style="font-size: 4.5rem; font-weight: 800; margin-bottom: 1.5rem; text-shadow: 0 10px 20px rgba(0,0,0,0.5); line-height: 1.1;">Khám Phá Thế Giới<br><span style="background: -webkit-linear-gradient(45deg, #ec4899, #8b5cf6); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Chưa Từng Có</span></h1>
        <p style="font-size: 1.2rem; max-width: 650px; margin: 0 auto 2.5rem; line-height: 1.6; color: rgba(255,255,255,0.9);">Đặt những trải nghiệm khó quên và khám phá những viên ngọc ẩn giấu của hành tinh tươi đẹp của chúng ta với các tour du lịch được chọn lọc cẩn thận từ các chuyên gia.</p>
        <a href="#tours" class="btn hero-btn" style="background: linear-gradient(90deg, #ec4899 0%, #f43f5e 100%); border: none; padding: 1.2rem 3rem; font-size: 1.1rem; border-radius: 50px; font-weight: 700; box-shadow: 0 10px 25px rgba(236,72,153,0.4); transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;">Khám Phá Các Tour Ngay</a>
    </div>
</div>

<div id="tours" style="max-width: 1250px; margin: 0 auto; padding-bottom: 4rem;">
    <div style="text-align: center; margin-top: 6rem; padding: 0 20px; margin-bottom: 4rem;">
        <span style="color: var(--secondary-color); font-weight: 700; text-transform: uppercase; letter-spacing: 3px; font-size: 0.9rem; display: block; margin-bottom: 0.5rem;">Lựa chọn hàng đầu</span>
        <h2 style="font-size: 3rem; font-weight: 800; color: #1e293b; margin-top: 0;">Các Tour Phổ Biến Nổi Bật</h2>
        <div style="height: 4px; width: 60px; background: var(--secondary-color); margin: 1rem auto; border-radius: 2px;"></div>
    </div>

    <div class="tour-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 2.5rem; padding: 0 5%;">
        @forelse($tours as $tour)
        <div class="tour-card" style="background: white; border-radius: 24px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.06); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); position: relative;">
            @php
                // Prefer actual image from db if present, otherwise use fallback logic
                $img = $tour->images->first()->image_url ?? '';
                if(empty($img)) {
                    $img = 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=800&q=80';
                    if($loop->index % 3 == 1) $img = 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&w=800&q=80';
                    if($loop->index % 3 == 2) $img = 'https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=800&q=80';
                }
            @endphp
            <div class="tour-img hover-zoom" style="height: 250px; position: relative; overflow: hidden;">
                <div style="background-image: url('{{ $img }}'); height: 100%; width: 100%; background-size: cover; background-position: center; transition: transform 0.6s ease;"></div>
                <div class="tour-price" style="position: absolute; bottom: 20px; right: 20px; background: rgba(255,255,255,0.95); backdrop-filter: blur(8px); padding: 8px 18px; border-radius: 30px; font-weight: 800; color: var(--primary-color); font-size: 1.1rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                    {{ number_format($tour->price, 0) }} đ
                </div>
                <div style="position: absolute; top: 20px; left: 20px; background: rgba(0,0,0,0.6); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; backdrop-filter: blur(4px);">
                    {{ $tour->duration_days }}N/{{ $tour->duration_nights }}Đ
                </div>
            </div>
            <div class="tour-content" style="padding: 2rem;">
                <div style="display: flex; align-items: center; gap: 8px; color: var(--secondary-color); font-size: 0.85rem; font-weight: 700; margin-bottom: 0.75rem; text-transform: uppercase;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    {{ $tour->location->name ?? 'Khám phá Mới' }} &bull; {{ $tour->category->name ?? 'Đa dạng' }}
                </div>
                <h3 class="tour-title" style="font-size: 1.4rem; font-weight: 800; margin-bottom: 1rem; color: #0f172a; line-height: 1.4;">{{ $tour->name }}</h3>
                <div style="display: flex; gap: 15px; margin-bottom: 1.2rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 1.2rem;">
                    <div style="display: flex; align-items: center; gap: 5px; color: #64748b; font-size: 0.9rem; font-weight: 500;">
                        <span>👥 Tối đa:</span> <strong style="color: #334155;">{{ $tour->max_people ?: 'Không giới hạn' }}</strong>
                    </div>
                </div>
                <p class="tour-desc" style="color: #64748b; font-size: 0.95rem; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 1.5rem;">
                    {{ $tour->description ?: "Tuyệt tác thiên nhiên & văn hóa hội tụ. Tham gia cùng chúng tôi để có một trải nghiệm lưu giữ mãi trong tâm hồn. Đặt ngay để nhận ưu đãi đặc biệt." }}
                </p>
                
                <a href="{{ route('tours.show', $tour->id) }}" class="btn" style="width: 100%; text-align: center; background: #f8fafc; color: var(--primary-color); border: 2px solid #e2e8f0; font-weight: 700; padding: 0.8rem 0; border-radius: 12px; transition: all 0.3s ease;">Xem Chi Tiết Tour</a>
            </div>
        </div>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 5rem 2rem; background: linear-gradient(to bottom right, #f8fafc, #f1f5f9); border-radius: 30px; border: 2px dashed #cbd5e1;">
            <div style="font-size: 3rem; margin-bottom: 1rem;">🏝️</div>
            <h3 style="color: #475569; font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">Chưa có tour nào khả dụng!</h3>
            <p style="color: #94a3b8;">Có vẻ như hệ thống đang được nâng cấp, bạn vui lòng quay lại sau nhé.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    .tour-card:hover { 
        transform: translateY(-12px); 
        box-shadow: 0 20px 40px rgba(0,0,0,0.12); 
    }
    .tour-card:hover .tour-img > div:first-child {
        transform: scale(1.1);
    }
    .hero-btn:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 15px 30px rgba(236,72,153,0.5) !important;
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .tour-card .btn:hover {
        background: var(--primary-color) !important;
        color: white !important;
        border-color: var(--primary-color) !important;
    }
</style>
@endsection
