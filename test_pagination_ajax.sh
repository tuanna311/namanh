#!/bin/bash

# Script test AJAX pagination cho trang Dự án
# Usage: bash test_pagination_ajax.sh

echo "=== Test AJAX Pagination - Trang Dự án ==="
echo ""

# Lấy nonce từ trang chính
echo "1. Lấy nonce từ trang /du-an/..."
NONCE=$(curl -s "http://namanh.local/du-an/" | grep -o 'data-nonce="[^"]*"' | head -1 | cut -d'"' -f2)

if [ -z "$NONCE" ]; then
  echo "❌ Không lấy được nonce. Kiểm tra lại trang /du-an/"
  exit 1
fi

echo "✅ Nonce: $NONCE"
echo ""

# Test AJAX request trang 2
echo "2. Test AJAX request - Trang 2..."
RESPONSE=$(curl -s -X POST "http://namanh.local/wp-admin/admin-ajax.php" \
  -d "action=namanh_portfolio_page" \
  -d "nonce=$NONCE" \
  -d "page=2" \
  -d "per_page=6" \
  -d 'atts={"_id":"portfolio-du-an-1","cat":"","per_page":"6"}')

# Parse JSON response
SUCCESS=$(echo "$RESPONSE" | grep -o '"success":[^,}]*' | cut -d':' -f2)
TOTAL_PAGES=$(echo "$RESPONSE" | grep -o '"total_pages":[0-9]*' | cut -d':' -f2)
TOTAL_ITEMS=$(echo "$RESPONSE" | grep -o '"total_items":[0-9]*' | cut -d':' -f2)
PAGE=$(echo "$RESPONSE" | grep -o '"page":[0-9]*' | cut -d':' -f2)

echo ""
echo "=== Kết quả AJAX Response ==="
echo "Success: $SUCCESS"
echo "Page: $PAGE"
echo "Total Pages: $TOTAL_PAGES"
echo "Total Items: $TOTAL_ITEMS"

# Kiểm tra có pagination HTML không
HAS_PAGINATION=$(echo "$RESPONSE" | grep -c 'namanh-portfolio-pagination')

if [ "$HAS_PAGINATION" -gt 0 ]; then
  echo "✅ Pagination HTML: Có"

  # Đếm số button
  BUTTON_COUNT=$(echo "$RESPONSE" | grep -o 'namanh-page-btn' | wc -l | tr -d ' ')
  echo "   Số lượng buttons: $BUTTON_COUNT"

  # Kiểm tra nút Next có disabled không (trang cuối)
  NEXT_DISABLED=$(echo "$RESPONSE" | grep -c 'namanh-page-next.*disabled')
  if [ "$NEXT_DISABLED" -gt 0 ]; then
    echo "   ✅ Nút Next: disabled (đúng - đây là trang cuối)"
  else
    echo "   ℹ️  Nút Next: enabled"
  fi

  # Kiểm tra nút Prev có disabled không
  PREV_DISABLED=$(echo "$RESPONSE" | grep -c 'namanh-page-prev.*disabled')
  if [ "$PREV_DISABLED" -gt 0 ]; then
    echo "   ℹ️  Nút Prev: disabled"
  else
    echo "   ✅ Nút Prev: enabled (đúng - không phải trang đầu)"
  fi

else
  echo "❌ Pagination HTML: Không có"
fi

echo ""
echo "=== Kết luận ==="
if [ "$SUCCESS" = "true" ] && [ "$HAS_PAGINATION" -gt 0 ]; then
  echo "✅ AJAX pagination hoạt động tốt!"
else
  echo "❌ Có vấn đề với AJAX pagination"
  echo ""
  echo "Full response:"
  echo "$RESPONSE" | head -50
fi

