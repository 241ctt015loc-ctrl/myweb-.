<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $story->TenTruyen }} - Chi tiết</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="main-header">
        <nav class="navbar">
            <div class="logo"><a href="/">📚 <span>Đệ Nhất</span> Truyện</a></div>
            <ul class="nav-links">
                <li><a href="/" style="text-decoration: none; color: #333; font-weight: bold;"><i class="fas fa-arrow-left"></i> Quay lại Trang chủ</a></li>
            </ul>
        </nav>
    </header>

    <main class="content-wrapper">
        <div class="story-detail-container" style="display: flex; gap: 40px; background: #fff; padding: 30px; border-radius: 15px; margin-top: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
            
            <div class="detail-img" style="flex: 1;">
                <img src="{{ asset('images/' . $story->HinhAnh) }}" style="width: 100%; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
            </div>

            <div class="detail-info" style="flex: 2;">
                <h1 style="font-size: 2.5rem; color: #2c3e50;">{{ $story->TenTruyen }}</h1>
                <p style="font-size: 1.5rem; color: #e44d26; font-weight: bold; margin: 20px 0;">
                    Giá: {{ number_format($story->GiaBan, 0, ',', '.') }} VNĐ
                </p>
                <div class="description" style="margin-bottom: 25px; color: #7f8c8d;">
                    <h3 style="color: #333;">Giới thiệu:</h3>
                    <p>Đây là những dòng giới thiệu hấp dẫn về cuốn truyện {{ $story->TenTruyen }}. Bạn sẽ được trải nghiệm những tình tiết lôi cuốn...</p>
                </div>

                <form action="{{ route('cart.add', $story->id) }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: bold; display: block; margin-bottom: 10px;">Số lượng muốn mua:</label>
                        <input type="number" name="so_luong" value="1" min="1" max="{{ $story->SoLuongTon }}" 
                               style="padding: 10px; width: 80px; border-radius: 5px; border: 1px solid #ddd;">
                        <span style="color: #999; margin-left: 10px;">(Còn {{ $story->SoLuongTon }} cuốn trong kho)</span>
                    </div>

                    <button type="submit" class="btn-buy" style="border: none; cursor: pointer; width: 250px; padding: 15px; font-size: 1.1rem; background-color: #2f3542; color: #fff; border-radius: 8px; font-weight: bold; transition: 0.3s;">
                        <i class="fas fa-cart-plus"></i> THÊM VÀO GIỎ HÀNG
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>