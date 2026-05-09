function equalizeH3Heights() {
	const h3s = document.querySelectorAll('.text.description-cong-nghe');
	if (!h3s.length) return;

	// Reset height về auto để tính lại đúng
	h3s.forEach(h3 => h3.style.height = 'auto');

	// Lấy chiều cao lớn nhất
	let maxHeight = 0;
	h3s.forEach(h3 => {
		maxHeight = Math.max(maxHeight, h3.offsetHeight);
	});

	// Áp chiều cao lớn nhất cho tất cả
	h3s.forEach(h3 => h3.style.height = maxHeight + 'px');
}

// Gọi khi load trang và khi resize
window.addEventListener('load', equalizeH3Heights);
window.addEventListener('resize', () => {
	clearTimeout(window.equalizeH3Timer);
	window.equalizeH3Timer = setTimeout(equalizeH3Heights, 150);
});

document.addEventListener('DOMContentLoaded', function() {
  const link = document.querySelector('a[href="https://groupnamanh.com/du-an/thi-cong-noi-that,thiet-ke-noi-that/phu-kien/"]');
  if (link) {
    link.addEventListener('click', function(e) {
      e.preventDefault(); // Ngăn link gốc hoạt động
      window.location.href = '/phu-kien/'; // Redirect đến trang mới
    });
  }
});
