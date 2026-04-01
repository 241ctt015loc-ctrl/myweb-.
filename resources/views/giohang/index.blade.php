<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng - Đệ Nhất Truyện</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f4f6f9; padding: 50px 0; }
        .cart-container { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
        .img-cart { width: 80px; height: 110px; object-fit: cover; border-radius: 5px; }
        .total-price { font-size: 24px; color: #e44d26; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="cart-container">
            <h2 class="mb-4 text-center">🛒 GIỎ HÀNG CỦA BẠN</h2>
            
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên truyện</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    
                    {{-- Kiểm tra xem có hàng trong Session không --}}
                    @if(session('gio_hang'))
                        @foreach(session('gio_hang') as $id => $details)
                            {{-- Ép kiểu giá bán thành số trước khi tính toán để PHP không bị lú --}}
                            @php $total += (float)$details['gia_ban'] * $details['so_luong']; @endphp
                            
                            <tr>
                                <td><img src="{{ asset('images/' . $details['hinh_anh']) }}" class="img-cart"></td>
                                <td class="align-middle"><strong>{{ $details['ten_truyen'] }}</strong></td>
                                
                                {{-- Ép kiểu hiển thị giá --}}
                                <td class="align-middle">{{ number_format((float)$details['gia_ban'], 0, ',', '.') }} đ</td>
                                
                                <td class="align-middle">{{ $details['so_luong'] }}</td>
                                
                                {{-- Ép kiểu hiển thị Thành tiền --}}
                                <td class="align-middle">{{ number_format((float)$details['gia_ban'] * $details['so_luong'], 0, ',', '.') }} đ</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">Giỏ hàng đang trống!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
    <div style="margin-top: 30px; display: flex; justify-content: space-between;">
         <a ><a href="{{ url('/') }}" style="padding: 12px 20px; background-color: #2c3e50; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; transition: 0.3s;">
        ⬅ Tiếp tục chọn truyện
</a>
     </div>
            <div class="text-right mt-4">
                {{-- Tổng tiền cũng được fomat lại cho đẹp --}}
                <h4>Tổng thanh toán: <span class="total-price">{{ number_format($total, 0, ',', '.') }} VNĐ</span></h4>
                <a href="{{ url('/') }}" class="btn btn-secondary mt-2">Tiếp tục mua truyện</a>
                <button class="btn btn-danger mt-2">Thanh toán ngay</button>
            </div>
        </div>
    </div>
</body>
</html>
