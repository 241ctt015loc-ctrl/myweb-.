// Đợi cho DOM load xong mới chạy script
document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Hiệu ứng thay đổi màu Header khi cuộn trang
    const header = document.querySelector('.main-header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.style.padding = '0.5rem 5%';
            header.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
        } else {
            header.style.padding = '1rem 5%';
            header.style.backgroundColor = '#fff';
        }
    });

    // 2. Xử lý sự kiện click vào nút "Thêm vào giỏ"
    // (Nếu ông dùng Laravel, cái này thường để hiển thị loading trước khi chuyển trang)
    const buyButtons = document.querySelectorAll('.btn-buy');
    buyButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Hiệu ứng rung nhẹ nút khi bấm
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 100);
        });
    });

    // 3. Tự động ẩn thông báo SweetAlert sau khi hiện (nếu cần tùy biến thêm)
    // Phần này thường đã được SweetAlert tự xử lý bằng thuộc tính 'timer'
});

// 4. Hàm thông báo nhanh (Có thể gọi từ bất kỳ đâu)
function notifySuccess(msg) {
    Swal.fire({
        icon: 'success',
        title: 'Thông báo',
        text: msg,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2500
    });
}
