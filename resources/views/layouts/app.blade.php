<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Explore the World') - {{ config('app.name', 'TourBooking') }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #fafafa; }
        .hero {
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?ixlib=rb-4.0.3&auto=format&fit=crop&w=2021&q=80') center/cover;
            height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding: 0 20px;
        }
        .hero h1 { font-size: 4rem; font-weight: 800; margin-bottom: 1rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); }
        .hero p { font-size: 1.25rem; max-width: 600px; margin: 0 auto 2rem; }
        .navbar {
            position: absolute; top: 0; left: 0; right: 0;
            padding: 1.5rem 5%; display: flex; justify-content: space-between; align-items: center;
            z-index: 100;
        }
        .nav-links a { color: white; text-decoration: none; margin-left: 2rem; font-weight: 500; font-size: 1.1rem; transition: opacity 0.3s; }
        .nav-links a:hover { opacity: 0.8; }
        .glass-nav { background: rgba(0,0,0,0.2); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(255,255,255,0.1); position: fixed; width: 100%; box-sizing: border-box; }
        
        /* Tour Cards */
        .tour-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem; padding: 4rem 5%; }
        .tour-card {
            background: white; border-radius: 20px; overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .tour-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.12); }
        .tour-img { height: 220px; background-color: #eee; position: relative; background-size: cover; background-position: center; }
        .tour-price { position: absolute; bottom: 15px; right: 15px; background: rgba(255,255,255,0.9); backdrop-filter: blur(5px); padding: 5px 15px; border-radius: 30px; font-weight: 700; color: var(--primary-color); }
        .tour-content { padding: 1.5rem; }
        .tour-title { font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem; color: #1f2937; }
        .tour-meta { display: flex; justify-content: space-between; color: #6b7280; font-size: 0.9rem; margin-bottom: 1rem; }
        .tour-desc { color: #4b5563; font-size: 0.95rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 1.5rem; }
        
        .footer { background: #111827; color: white; padding: 4rem 5% 2rem; text-align: center; }
    </style>
</head>
<body>
    <nav class="navbar glass-nav">
        <div style="font-size: 1.5rem; font-weight: 800; color: white; letter-spacing: 1px;">🌍 Đặt Tour NHANH</div>
        <div class="nav-links">
            <a href="/">Trang chủ</a>
            <a href="/#tours">Điểm đến</a>
            <a href="{{ route('blogs.index') }}">Cẩm nang</a>
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}">Quản trị viên</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">@csrf <button type="submit" style="background:none;border:none;color:white;font-family:inherit;font-size:1.1rem;font-weight:500;cursor:pointer;margin-left:2rem;">Đăng xuất</button></form>
            @else
                <a href="{{ route('login') }}" style="background: white; color: var(--primary-color); padding: 0.5rem 1.5rem; border-radius: 30px;">Đăng Nhập</a>
            @endauth
        </div>
    </nav>

    @yield('content')

    @include('partials.chatbot')

    <footer class="footer">
        <h3>Đặt Tour NHANH</h3>
        <p style="color: #9ca3af; margin-top: 1rem;">Khám phá giấc mơ du lịch của bạn một cách tuyệt vời và dễ dàng nhất.</p>
        <div style="margin-top: 2rem; border-top: 1px solid #374151; padding-top: 2rem; color: #6b7280; font-size: 0.9rem;">
            &copy; {{ date('Y') }} Đặt Tour VN. Bản quyền thuộc về chúng tôi.
        </div>
    </footer>
</body>
</html>
