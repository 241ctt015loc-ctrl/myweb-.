<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Đệ Nhất Truyện</title>
    <style>
        body { background-color: #121212; color: white; font-family: sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .login-box { background-color: #1e1e1e; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.5); width: 100%; max-width: 400px; text-align: center; }
        h2 { color: #ff2d20; margin-bottom: 20px; }
        input { width: 100%; padding: 12px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #333; background: #2c2c2c; color: white; box-sizing: border-box; }
        button { width: 100%; padding: 12px; border: none; border-radius: 5px; background-color: #ff2d20; color: white; font-weight: bold; cursor: pointer; transition: 0.3s; }
        button:hover { background-color: #e0261d; }
        .error { color: #ff4d4d; font-size: 14px; margin-bottom: 10px; text-align: left; }
    </style>
</head>
<body>

<div class="login-box">
    <h2>ĐĂNG KÝ</h2>

    <form action="{{ route('register') }}" method="POST">
        @csrf 

        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Họ và tên của bạn">
        
        <input type="email" name="email" value="{{ old('email') }}" required placeholder="Địa chỉ Email">
        
        <input type="password" name="password" required placeholder="Mật khẩu (ít nhất 6 ký tự)">
        
        <input type="password" name="password_confirmation" required placeholder="Nhập lại mật khẩu">

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif

        <button type="submit">Đăng Ký Ngay</button>
    </form>
    
    <p style="margin-top: 20px; font-size: 14px; color: #888;">
        Đã có tài khoản? <a href="{{ route('login') }}" style="color: #ff2d20; text-decoration: none;">Đăng nhập</a>
    </p>
</div>

</body>
</html>