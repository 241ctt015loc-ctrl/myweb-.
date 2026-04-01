// Đợi cho DOM load xong mới chạy script
document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Hiệu ứng thay đổi kích thước Header khi cuộn trang
    const header = document.querySelector('.main-header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.style.padding = '5px 20px'; // Thu nhỏ header
            header.style.backgroundColor = 'rgba(255, 255, 255, 0.98)';
        } else {
            header.style.padding = '15px 20px'; // Trở lại ban đầu
            header.style.backgroundColor = '#fff';
        }
    });

    // 2. Hiệu ứng click cho các nút bấm (Rung nhẹ)
    const allButtons = document.querySelectorAll('.btn-buy, .btn-banner, .btn-submit-filter');
    allButtons.forEach(button => {
        button.addEventListener('mousedown', function() {
            this.style.transform = 'scale(0.95)';
        });
        button.addEventListener('mouseup', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // 3. XỬ LÝ BẢNG THỂ LOẠI (MODAL)
    const filterModal = document.getElementById('filterModal');
    
    // Hàm mở bảng (Gán vào cửa sổ để có thể gọi từ HTML onclick)
    window.openFilter = function() {
        if(filterModal) {
            filterModal.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Chặn cuộn trang khi đang mở bảng
        }
    };

    // Hàm đóng bảng
    window.closeFilter = function() {
        if(filterModal) {
            filterModal.style.display = 'none';
            document.body.style.overflow = 'auto'; // Cho phép cuộn trang lại
        }
    };

    // Đóng bảng khi click ra ngoài vùng trắng (vùng mờ đen)
    window.addEventListener('click', function(event) {
        if (event.target == filterModal) {
            closeFilter();
        }
    });

    // Đóng bảng khi nhấn phím ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeFilter();
        }
    });

});

/**
 * 4. Hàm thông báo nhanh (Sử dụng SweetAlert2)
 * Có thể gọi: notifySuccess('Đã thêm thành công');
 */
function notifySuccess(msg) {
    Swal.fire({
        icon: 'success',
        title: 'Thành công!',
        text: msg,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true
    });
}