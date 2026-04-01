<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .checkout-container { max-width: 1000px; margin: 50px auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .order-summary { background-color: #f8f9fa; padding: 20px; border-radius: 10px; border: 1px solid #dee2e6; }
        .btn-order { background: linear-gradient(135deg, #ff7e5f, #e44d26); color: white; font-weight: bold; padding: 12px; font-size: 1.1rem; border: none; width: 100%; border-radius: 8px; transition: 0.3s; }
        .btn-order:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(228, 77, 38, 0.4); color: white; }
    </style>
</head>
<body>

<div class="checkout-container">
    <h2 class="mb-4 text-center" style="color: #2c3e50; font-weight: bold;">XÁC NHẬN THANH TOÁN</h2>
    
    <div class="row">
        <div class="col-md-7">
            <h4 class="mb-3">Thông tin giao hàng</h4>
            <form action="{{ route('cart.process') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Họ và tên người nhận</label>
                    <input type="text" name="ho_ten" class="form-control" placeholder="Nhập họ tên đầy đủ..." required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="so_dien_thoai" class="form-control" placeholder="Nhập số điện thoại..." required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Địa chỉ nhận hàng</label>
                    <textarea name="dia_chi" class="form-control" rows="3" placeholder="Nhập số nhà, tên đường, phường/xã, quận/huyện..." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ghi chú thêm (Không bắt buộc)</label>
                    <textarea name="ghi_chu" class="form-control" rows="2" placeholder="Ví dụ: Giao giờ hành chính..."></textarea>
                </div>
                
                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary mt-3" style="border-radius: 8px; font-weight: 500;">
    ⬅ Quay lại giỏ hàng
</a>
        </div>

        <div class="col-md-5">
            <div class="order-summary">
                <h4 class="mb-3">Tóm tắt đơn hàng</h4>
                <hr>
                
                @php $total = 0; @endphp
                @foreach($gioHang as $id => $item)
                    @php $total += $item['gia_ban'] * $item['so_luong']; @endphp
                    <div class="d-flex justify-content-between mb-2">
                        <span style="font-size: 0.9rem;">
                            <strong>{{ $item['so_luong'] }}x</strong> {{ $item['ten_truyen'] }}
                        </span>
                        <span class="text-danger fw-bold">
                            {{ number_format((float)$item['gia_ban'] * $item['so_luong'], 0, ',', '.') }} đ
                        </span>
                    </div>
                @endforeach
                
                <hr>
                <div class="d-flex justify-content-between mb-4">
                    <strong class="fs-5">TỔNG CỘNG:</strong>
                    <strong class="fs-5 text-danger">{{ number_format($total, 0, ',', '.') }} VNĐ</strong>
                </div>

                <button type="submit" class="btn-order">CHỐT ĐƠN HÀNG 🚀</button>
            </form> </div>
        </div>
    </div>
</div>

</body>
</html>