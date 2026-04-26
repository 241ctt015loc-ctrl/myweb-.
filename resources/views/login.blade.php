<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Đệ Nhất Truyện</title>
    <style>
        body { background-color: #121212; color: white; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background-color: #1e1e1e; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.5); width: 100%; max-width: 400px; text-align: center; }
        h2 { color: #ff2d20; margin-bottom: 25px; }
        input { width: 100%; padding: 12px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #333; background: #2c2c2c; color: white; box-sizing: border-box; }
        button { width: 100%; padding: 12px; border: none; border-radius: 5px; background-color: #ff2d20; color: white; font-weight: bold; cursor: pointer; transition: 0.3s; }
        button:hover { background-color: #e0261d; }
        .error { color: #ff4d4d; font-size: 14px; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="login-box">
    <h2>ĐĂNG NHẬP</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf 

        <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email của bạn">
        
        <input type="password" name="password" required placeholder="Mật khẩu">

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <button type="submit">Đăng Nhập</button>
    </form>
    
    <p style="margin-top: 20px; font-size: 14px; color: #888;">
        Chưa có tài khoản? <a href="#" style="color: #ff2d20; text-decoration: none;">Đăng ký ngay</a>
    </p>
</div>

</body>
</html>