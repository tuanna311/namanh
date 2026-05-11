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
 * Phân trang số – Portfolio Dự án (AJAX)
 * Xử lý click số trang / nút prev-next, thay toàn bộ lưới
 * ============================================================
 */
(function ($) {
  'use strict';

  $(document).on('click', '.namanh-portfolio-pagination .namanh-page-btn', function () {
    var $btn    = $(this);
    if ($btn.prop('disabled') || $btn.hasClass('active')) return;

    // Lấy wrapper và thông tin cần thiết trước khi AJAX
    var $wrapper  = $btn.closest('.namanh-portfolio-paged-wrapper');
    if (!$wrapper.length) return;

    var $gridArea = $wrapper.find('.namanh-portfolio-grid-area');
    var page      = parseInt($btn.data('page'), 10);
    var perPage   = parseInt($wrapper.data('per-page'), 10);
    var nonce     = $wrapper.data('nonce');
    var atts      = $wrapper.attr('data-atts');
    var ajaxUrl   = (typeof namanhVars !== 'undefined') ? namanhVars.ajaxUrl : '/wp-admin/admin-ajax.php';

    // Hiệu ứng loading
    $gridArea.addClass('is-loading');
    $wrapper.find('.namanh-portfolio-pagination .namanh-page-btn').prop('disabled', true);

    $.ajax({
      url: ajaxUrl,
      type: 'POST',
      data: {
        action:   'namanh_portfolio_page',
        nonce:    nonce,
        page:     page,
        per_page: perPage,
        atts:     atts
      },
      success: function (response) {
        $gridArea.removeClass('is-loading');

        if (!response.success || !response.data) {
          // Restore buttons nếu lỗi
          $wrapper.find('.namanh-portfolio-pagination .namanh-page-btn').prop('disabled', false);
          console.error('Portfolio Pagination: Lỗi server', response);
          return;
        }

        var data = response.data;
        
        // Debug logging (có thể comment out sau)
        // console.log('Portfolio AJAX Response:', {
        //   page: data.page,
        //   total_pages: data.total_pages,
        //   total_items: data.total_items,
        //   has_pagination_html: !!data.pagination_html
        // });

        // Cập nhật current page và total pages trên wrapper
        $wrapper.attr('data-current-page', data.page || page);
        if (typeof data.total_pages !== 'undefined') {
          $wrapper.attr('data-total-pages', data.total_pages);
        }

        // Thay thế pagination bằng HTML mới từ server
        var $currentPagination = $wrapper.find('.namanh-portfolio-pagination');
        if ($currentPagination.length) {
          if (data.pagination_html && data.pagination_html.trim() !== '') {
            // Có HTML pagination mới → replace
            $currentPagination.replaceWith(data.pagination_html);
          } else {
            // Không có pagination (total_pages <= 1) → xóa pagination cũ
            $currentPagination.remove();
          }
        } else if (data.pagination_html && data.pagination_html.trim() !== '') {
          // Chưa có pagination element nhưng response có HTML → append vào wrapper
          $wrapper.append(data.pagination_html);
        }

        // Tìm masonry container bên trong grid area
        var $container = $gridArea.find('[data-packery-options]').first();

        if ($container.length && data.html) {
          $container.empty();
          var $newItems = $(data.html);
          $container.append($newItems);

          if ($.fn.packery) {
            if (typeof imagesLoaded !== 'undefined') {
              imagesLoaded($container[0], function () {
                if ($container.data('packery')) {
                  $container.packery('layout');
                } else {
                  $container.packery({ originLeft: true });
                }
              });
            } else {
              if ($container.data('packery')) {
                $container.packery('layout');
              }
            }
          }
        } else if (data.html) {
          $gridArea.html(data.html);
        }

        // Cuộn lên đầu portfolio wrapper
        $('html, body').animate({
          scrollTop: $wrapper.offset().top - 80
        }, 300);
      },
      error: function (xhr, status, error) {
        $gridArea.removeClass('is-loading');
        $wrapper.find('.namanh-portfolio-pagination .namanh-page-btn').prop('disabled', false);
        console.error('Portfolio Pagination: AJAX error', status, error);
      }
    });
  });

  /**
   * Xử lý click phân trang cho Blog / Tin tức
   */
  $(document).on('click', '.namanh-blog-paged-wrapper .namanh-portfolio-pagination .namanh-page-btn', function () {
    var $btn    = $(this);
    if ($btn.prop('disabled') || $btn.hasClass('active')) return;

    var $wrapper  = $btn.closest('.namanh-blog-paged-wrapper');
    if (!$wrapper.length) return;

    var $gridArea = $wrapper.find('.namanh-blog-grid-area');
    var page      = parseInt($btn.data('page'), 10);
    var perPage   = parseInt($wrapper.data('per-page'), 10);
    var nonce     = $wrapper.data('nonce');
    var atts      = $wrapper.attr('data-atts');
    var ajaxUrl   = (typeof namanhVars !== 'undefined') ? namanhVars.ajaxUrl : '/wp-admin/admin-ajax.php';

    $gridArea.addClass('is-loading');
    $wrapper.find('.namanh-portfolio-pagination .namanh-page-btn').prop('disabled', true);

    $.ajax({
      url: ajaxUrl,
      type: 'POST',
      data: {
        action:   'namanh_blog_page',
        nonce:    nonce,
        page:     page,
        per_page: perPage,
        atts:     atts
      },
      success: function (response) {
        $gridArea.removeClass('is-loading');

        if (!response.success || !response.data) {
          $wrapper.find('.namanh-portfolio-pagination .namanh-page-btn').prop('disabled', false);
          return;
        }

        var data = response.data;
        $wrapper.attr('data-current-page', data.page || page);
        if (typeof data.total_pages !== 'undefined') {
          $wrapper.attr('data-total-pages', data.total_pages);
        }

        var $currentPagination = $wrapper.find('.namanh-portfolio-pagination');
        if ($currentPagination.length) {
          if (data.pagination_html && data.pagination_html.trim() !== '') {
            $currentPagination.replaceWith(data.pagination_html);
          } else {
            $currentPagination.remove();
          }
        } else if (data.pagination_html && data.pagination_html.trim() !== '') {
          $wrapper.append(data.pagination_html);
        }

        if (data.html) {
          $gridArea.html(data.html);
          // Kích hoạt lại hiệu ứng Scroll Reveal cho nội dung mới load (nếu cần)
          // Tương tự animate của flatsome
          if (typeof window.Flatsome !== 'undefined' && Flatsome.attach) {
            Flatsome.attach($gridArea);
          }
        }

        // Cuộn lên đầu blog wrapper
        $('html, body').animate({
          scrollTop: $wrapper.offset().top - 80
        }, 300);
      },
      error: function () {
        $gridArea.removeClass('is-loading');
        $wrapper.find('.namanh-portfolio-pagination .namanh-page-btn').prop('disabled', false);
      }
    });
  });

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
            // Lấy vị trí của khối so với khung nhìn hiện tại khi vừa load
            const rect = el.getBoundingClientRect();
            
            // Nếu khối nằm trong hoặc sát khung nhìn đầu tiên (có thể đang hiển thị)
            // ta KHÔNG áp dụng hiệu ứng để tránh khối bị giật hoặc biến mất rồi hiện lại
            if (rect.top < window.innerHeight - 50) {
                return; // Bỏ qua, để khối hiển thị bình thường
            }
            
            // Chỉ thêm hiệu ứng cho các khối nằm bên dưới khung nhìn
            el.classList.add('namanh-reveal');
            revealObserver.observe(el);
        }
    });
});