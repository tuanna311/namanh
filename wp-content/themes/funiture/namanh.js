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

/**
 * Xử lý Showcase Sản phẩm (Tab và Hover ảnh)
 */
function initNamanhShowcase() {
  const showcase = document.querySelector('.namanh-showcase');
  if (!showcase) return;

  const tabBtns = showcase.querySelectorAll('.showcase-tab-btn');
  const panels = showcase.querySelectorAll('.showcase-panel');

  // Xử lý chuyển TAB
  tabBtns.forEach(btn => {
    btn.addEventListener('click', function () {
      const targetId = this.getAttribute('data-target');

      // Update nút tab
      tabBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');

      // Update panel nội dung
      panels.forEach(p => p.classList.remove('active'));
      const targetPanel = document.getElementById(targetId);
      if (targetPanel) {
        targetPanel.classList.add('active');
      }
    });
  });

  // Xử lý HOVER các mục con để đổi ảnh (Desktop)
  showcase.addEventListener('mouseover', function (e) {
    // Chỉ xử lý trên màn hình lớn
    if (window.innerWidth <= 850) return;

    const item = e.target.closest('.subcat-item');
    if (!item) return;

    const panel = item.closest('.showcase-panel');
    if (!panel) return;

    const items = Array.from(panel.querySelectorAll('.subcat-item'));
    const previews = Array.from(panel.querySelectorAll('.image-preview'));
    const index = items.indexOf(item);

    if (index !== -1) {
      // Update active class cho menu bên trái
      items.forEach(si => si.classList.remove('active'));
      item.classList.add('active');

      // Update active class cho các khối image-preview bên phải
      previews.forEach((p, pIndex) => {
        if (pIndex === index) {
          p.classList.add('active');
        } else {
          p.classList.remove('active');
        }
      });
    }
  });
}

// Chạy khi DOM sẵn sàng
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initNamanhShowcase);
} else {
  initNamanhShowcase();
}

// Chạy lại sau một khoảng thời gian ngắn để đảm bảo UX Builder đã render xong
window.addEventListener('load', () => {
  setTimeout(initNamanhShowcase, 500);
});

/**
 * ============================================================
 * Load More – Phân trang dự án (AJAX)
 * Xử lý click nút "Xem thêm dự án" và append item vào lưới masonry
 * ============================================================
 */
(function ($) {
  'use strict';

  $(document).on('click', '.namanh-load-more-btn', function () {
    var $btn = $(this);
    var $wrapper = $btn.closest('.namanh-load-more-wrapper');

    // Ngăn double-click khi đang tải
    if ($btn.hasClass('is-loading')) return;

    var portfolioId = $btn.data('portfolio-id');
    var offset = parseInt($btn.data('offset'), 10);
    var perPage = parseInt($btn.data('per-page'), 10);
    var total = parseInt($btn.data('total'), 10);
    var nonce = $btn.data('nonce');
    var atts = $btn.attr('data-atts'); // Lấy raw string (jQuery không tự parse)

    // Trạng thái đang tải
    $btn.addClass('is-loading');
    $btn.find('.namanh-btn-label').hide();
    $btn.find('.namanh-btn-loading').show();

    // Lấy AJAX URL từ biến PHP được truyền qua wp_localize_script
    var ajaxUrl = (typeof namanhVars !== 'undefined') ? namanhVars.ajaxUrl : '/wp-admin/admin-ajax.php';

    $.ajax({
      url: ajaxUrl,
      type: 'POST',
      data: {
        action: 'namanh_load_more_portfolio',
        nonce: nonce,
        offset: offset,
        per_page: perPage,
        atts: atts
      },
      success: function (response) {
        if (!response.success) {
          console.error('Load More Portfolio: Lỗi từ server', response);
          resetBtn($btn);
          return;
        }

        var data = response.data;

        if (!data.html) {
          resetBtn($btn);
          return;
        }

        // Tìm masonry container bằng DOM traversal (tránh lỗi duplicate ID của Flatsome)
        // Cấu trúc: [portfolio-element-wrapper] → [namanh-load-more-wrapper]
        var $portfolioOuter = $wrapper.prev();
        // Tìm inner masonry row có data-packery-options
        var $container = $portfolioOuter.find('[data-packery-options]').first();
        if (!$container.length) {
          // Fallback: dùng ID selector nếu không tìm được qua DOM
          $container = $('#' + portfolioId + '[data-packery-options]');
        }
        if (!$container.length) {
          console.error('Load More Portfolio: Không tìm thấy masonry container');
          resetBtn($btn);
          return;
        }

        // Tạo jQuery elements từ HTML response
        var $newItems = $(data.html);

        // Append vào container masonry
        $container.append($newItems);

        // Reinit Packery (masonry) cho items mới
        if ($.fn.packery && $container.data('packery')) {
          $newItems.imagesLoaded(function () {
            $container.packery('appended', $newItems);
          });
        } else if ($.fn.packery) {
          // Packery chưa init trên container này – thử layout lại
          $newItems.imagesLoaded(function () {
            $container.packery({ originLeft: true });
            $container.packery('layout');
          });
        }

        // Cập nhật offset trên button
        var newOffset = data.new_offset;
        $btn.data('offset', newOffset);

        // Cập nhật counter "Đang hiển thị X / Y dự án"
        $wrapper.find('.shown').text(newOffset);

        if (!data.has_more) {
          // Đã tải hết – ẩn nút
          $wrapper.fadeOut(300);
        } else {
          // Còn item – reset nút về trạng thái bình thường
          resetBtn($btn);
        }
      },
      error: function (xhr, status, error) {
        console.error('Load More Portfolio: AJAX error', status, error);
        resetBtn($btn);
      }
    });
  });

  /**
   * Reset trạng thái nút về bình thường
   */
  function resetBtn($btn) {
    $btn.removeClass('is-loading');
    $btn.find('.namanh-btn-label').show();
    $btn.find('.namanh-btn-loading').hide();
  }

}(jQuery));

/**
 * Xử lý hiệu ứng cuộn text cho menu có class nav-top-link
 */
document.addEventListener('DOMContentLoaded', function() {
  const navLinks = document.querySelectorAll('.nav-top-link > a, a.nav-top-link');
  
  navLinks.forEach(link => {
    // Tránh áp dụng nhiều lần
    if (link.querySelector('.roll-text-container')) return;

    // Tìm text node
    let textNode = null;
    let textString = '';
    
    for (let i = 0; i < link.childNodes.length; i++) {
      let node = link.childNodes[i];
      if (node.nodeType === Node.TEXT_NODE && node.textContent.trim() !== '') {
        textNode = node;
        textString = node.textContent.trim();
        break;
      }
    }

    if (textNode) {
      // Tạo wrapper
      const container = document.createElement('span');
      container.className = 'roll-text-container';
      
      const inner = document.createElement('span');
      inner.className = 'roll-text-inner';
      inner.setAttribute('data-text', textString);
      inner.textContent = textString;
      
      container.appendChild(inner);
      
      // Thay thế textNode bằng container
      link.replaceChild(container, textNode);
    }
  });
});

/**
 * Hiệu ứng Scroll Reveal tương tự An Cường
 */
document.addEventListener('DOMContentLoaded', function() {
    // Các selector của các khối chính sẽ được áp dụng hiệu ứng (không áp dụng vào các phần tử quá nhỏ)
    const selectors = [
        '.section',
        '.row:not(.row-small):not(.is-collapse)', // Tránh các row quá nhỏ bên trong
        '.product-small',
        '.box-blog-post',
        '.namanh-showcase',
        '.slider-chung-chi',
        '.slider-the-manh',
        '.block-cong-nghe',
        '.ux-banner'
    ];
    
    const revealElements = document.querySelectorAll(selectors.join(', '));
    if(!revealElements.length) return;

    // Cấu hình Intersection Observer
    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                // Hủy theo dõi sau khi đã hiển thị
                observer.unobserve(entry.target);
            }
        });
    }, {
        root: null,
        rootMargin: '0px 0px -10% 0px', // Bắt đầu hiệu ứng khi khối cuộn vào viewport 10%
        threshold: 0
    });

    revealElements.forEach(el => {
        // Chỉ thêm hiệu ứng nếu phần tử chưa có data-animate của Flatsome
        // để tránh xung đột hiệu ứng mặc định của theme
        if(!el.closest('[data-animate]') && !el.hasAttribute('data-animate')) {
            el.classList.add('namanh-reveal');
            revealObserver.observe(el);
        }
    });
});