<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đệ Nhất Truyện - Danh Sách</title>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* CSS CỦA ÔNG ĐÃ ĐƯỢC GIỮ NGUYÊN */
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            padding: 40px 20px; 
            background-color: #f4f6f9; 
            margin: 0;
        }
        h1 { 
            text-align: center; 
            color: #333;
            margin-bottom: 40px; 
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 800; 
        }
        h1 span { color: #e44d26; }
        .container { 
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); 
            gap: 30px; 
            max-width: 1200px; 
            margin: 0 auto;
        }
        .story-card {   
            background: white;
            border-radius: 16px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.06); 
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
            position: relative; 
            overflow: hidden; 
            border: 1px solid transparent; 
        }
        .story-card:hover {
            transform: translateY(-12px); 
            box-shadow: 0 20px 30px rgba(228, 77, 38, 0.25), 0 0 20px rgba(228, 77, 38, 0.15); 
            border-color: rgba(228, 77, 38, 0.3); 
            z-index: 10; 
        }
        .story-card img {
            width: 100%; 
            height: 320px;
            object-fit: cover; 
            border-radius: 10px; 
            transition: transform 0.5s ease; 
        }
        .story-card:hover img { 
            transform: scale(1.05); 
        }
        h2 {
            font-size: 1.25rem; 
            color: #2c3e50; 
            margin: 15px 0 10px;
            white-space: nowrap;
            overflow: hidden; 
            text-overflow: ellipsis; 
        }
        .price { 
            color: #e44d26; 
            font-weight: 800; 
            font-size: 1.3em; 
            margin: 10px 0; 
        }
        p { 
            color: #666; 
            font-size: 0.95rem; 
            margin-bottom: 15px; 
        }
        .btn-buy { 
            display: block;
            background: linear-gradient(135deg, #ff7e5f, #e44d26);
            color: white; 
            padding: 12px 20px;
            text-decoration: none; 
            border-radius: 8px;
            font-weight: bold; 
            text-transform: uppercase; 
            letter-spacing: 0.5px;
            transition: all 0.3s ease; 
            box-shadow: 0 4px 10px rgba(228, 77, 38, 0.3); 
        }
        .btn-buy:hover {
            background: linear-gradient(135deg, #e44d26, #c33816); 
            box-shadow: 0 6px 15px rgba(228, 77, 38, 0.5);
            transform: scale(1.02); 
        }
        
        /* CSS cho nút xem giỏ hàng trôi nổi */
        .cart-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #e44d26;
            color: white;
            padding: 15px 25px;
            border-radius: 50px;
            font-weight: bold;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            z-index: 1000;
            transition: all 0.3s;
        }
        .cart-float:hover {
            background-color: #c13b1a;
            color: white;
            transform: scale(1.1);
            text-decoration: none;
        }
        .cart-count {
            background-color: white;
            color: #e44d26;
            padding: 2px 8px;
            border-radius: 50%;
            margin-left: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>
   
    <h1>📚 Cung nghênh đến với <span> Đệ nhất truyện </span></h1>

    <div class="container">
    @foreach($stories as $story)
        <div class="story-card">
            <div style="overflow: hidden; border-radius: 10px;">
                <img src="{{ asset('images/' . $story->HinhAnh) }}" alt="Bìa truyện {{ $story->TenTruyen }}">
            </div>

            <h2>{{ $story->TenTruyen }}</h2>
            
            {{-- ĐÃ SỬA LỖI TẠI ĐÂY: Đổi gia_vnd thành GiaBan cho đúng Database --}}
            <p class="price">{{ number_format((float)$story->GiaBan, 0, ',', '.') }} VNĐ</p>
            
            <p>Số lượng còn: {{ $story->SoLuongTon }}</p>
            
            <a href="{{ route('cart.add', $story->id) }}" class="btn-buy">Thêm vào giỏ</a>
        </div>
    @endforeach 
    </div>

    {{-- Script hiển thị thông báo góc màn hình --}}
    @if(session('swal_success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: "{{ session('swal_success') }}",
            showConfirmButton: false,
            timer: 2000,
            toast: true,
            position: 'top-end'
        });
    </script>
    @endif

    {{-- Nút giỏ hàng lơ lửng góc phải --}}
    <a href="{{ route('cart.index') }}" class="cart-float">
        🛒 Giỏ hàng của tôi
        @if(session('gio_hang'))
            <span class="cart-count">{{ count(session('gio_hang')) }}</span>
        @endif
    </a>
</body>
</html>