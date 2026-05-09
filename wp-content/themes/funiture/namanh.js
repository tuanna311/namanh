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

function equalizeBlogBoxHeights() {
  const boxes = document.querySelectorAll('.box-blog-post .box-text');
  if (!boxes.length) return;

  boxes.forEach(box => box.style.height = 'auto');

  let maxHeight = 0;
  boxes.forEach(box => {
    maxHeight = Math.max(maxHeight, box.offsetHeight);
  });

  boxes.forEach(box => box.style.height = maxHeight + 'px');
}

// Gọi khi load trang và khi resize
window.addEventListener('load', () => {
  equalizeH3Heights();
  equalizeBlogBoxHeights();
});

window.addEventListener('resize', () => {
  clearTimeout(window.equalizeTimer);
  window.equalizeTimer = setTimeout(() => {
    equalizeH3Heights();
    equalizeBlogBoxHeights();
  }, 150);
});

document.addEventListener('DOMContentLoaded', function () {
  const link = document.querySelector('a[href="https://groupnamanh.com/du-an/thi-cong-noi-that,thiet-ke-noi-that/phu-kien/"]');
  if (link) {
    link.addEventListener('click', function (e) {
      e.preventDefault(); // Ngăn link gốc hoạt động
      window.location.href = '/phu-kien/'; // Redirect đến trang mới
    });
  }
});


document.addEventListener("DOMContentLoaded", function () {
  const section = document.querySelector('.namanh-video');
  if (!section) return;

  const video = section.querySelector('video');
  if (!video) return;

  // Thiết lập video cơ bản
  video.muted = true;
  video.playsInline = true;
  video.autoplay = true;
  video.loop = true;
  video.play().catch(() => { });

  let userInteracted = false; // đánh dấu xem user đã tương tác chưa

  // Lắng nghe lần tương tác đầu tiên (bất kỳ hành động nào)
  function markInteraction() {
    userInteracted = true;
    window.removeEventListener('scroll', markInteraction);
    window.removeEventListener('click', markInteraction);
    window.removeEventListener('touchstart', markInteraction);
  }
  window.addEventListener('scroll', markInteraction);
  window.addEventListener('click', markInteraction);
  window.addEventListener('touchstart', markInteraction);

  // Theo dõi vị trí khối video
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      const rect = section.getBoundingClientRect();
      const inView = rect.top < window.innerHeight && rect.bottom > 0;

      if (inView) {
        // Khi video hiển thị trong viewport
        if (userInteracted) {
          // Nếu người dùng đã từng tương tác → bật tiếng ngay
          video.muted = false;
          video.play().catch(() => { });
        } else {
          // Nếu chưa tương tác, đợi interaction rồi mới bật tiếng
          const enableSound = () => {
            video.muted = false;
            video.play().catch(() => { });
            window.removeEventListener('scroll', enableSound);
            window.removeEventListener('click', enableSound);
            window.removeEventListener('touchstart', enableSound);
          };
          window.addEventListener('scroll', enableSound);
          window.addEventListener('click', enableSound);
          window.addEventListener('touchstart', enableSound);
        }
      } else {
        // Khi cuộn qua hẳn video → tắt tiếng lại
        const completelyOut =
          rect.bottom < 0 || rect.top > window.innerHeight;
        if (completelyOut) {
          video.muted = true;
        }
      }
    });
  }, { threshold: [0, 0.25, 0.5, 0.75, 1] });

  observer.observe(section);
});

/**
 * Xử lý active tab từ URL hash (ví dụ: /tin-tuc/#tab_cam-nang)
 * Giúp tự động mở tab tương ứng khi click từ menu con
 */
function activateTabFromHash() {
  const hash = window.location.hash;
  if (!hash) return;

  try {
    // Decode hash để xử lý tiếng Việt (ví dụ: #tab_cẩm-nang)
    const decodedHash = decodeURIComponent(hash);
    
    // Tìm link tab trong cấu trúc Flatsome/UX Builder (.tabbed-content .nav a)
    // Thử nhiều selector phổ biến để đảm bảo hoạt động
    const tabLink = document.querySelector(`.tabbed-content .nav a[href="${decodedHash}"], .nav-link[href="${decodedHash}"], a[data-toggle="tab"][href="${decodedHash}"]`);
    
    if (tabLink) {
      // Trigger click để kích hoạt logic chuyển tab của theme
      tabLink.click();
      
      // Cuộn lên đầu trang theo yêu cầu của người dùng
      setTimeout(() => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }, 100);
    }
  } catch (e) {
    console.warn('Không thể active tab từ hash:', e);
  }
}

// Đợi trang load hoàn tất và các script theme đã khởi tạo xong
window.addEventListener('load', () => {
  setTimeout(activateTabFromHash, 600);
});

// Xử lý khi user click vào link menu cùng trang (chỉ đổi hash)
window.addEventListener('hashchange', activateTabFromHash);