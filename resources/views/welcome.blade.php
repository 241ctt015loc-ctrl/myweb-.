<!DOCTYPE html>
<html>
<head>
    <title>Đệ Nhất Truyện</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .story-card { border: 1px solid #ccc; padding: 15px; width: 300px; border-radius: 8px; }
        h1 { color: #333; }
    </style>
</head>
<body>
    <h1>Danh sách truyện mới nhất</h1>

    @foreach($stories as $story)
        <div class="story-card">
            <h2>{{ $story->title }}</h2>
            <p>Giá: {{ number_format($story->price) }} VNĐ</p>
            <p>Tóm tắt: {{ $story->summary }}</p>
            <a href="#">Đọc ngay</a>
        </div>
    @endforeach
</body>
</html>