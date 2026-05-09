<?php
// Add custom Theme Functions here
function flatsome_ux_builder_template_pttuan( $path ) {
  ob_start();
  include get_template_directory() . '/inc/builder/shortcodes/templates/' . $path;
  return ob_get_clean();
}
function flatsome_ux_builder_thumbnail_pttuan( $name ) {
  return get_template_directory_uri() . '/inc/builder/shortcodes/thumbnails/' . $name . '.svg';
}
function flatsome_ux_builder_template_thumb_pttuan( $name ) {
  return get_template_directory_uri() . '/inc/builder/templates/thumbs/' . $name . '.jpg';
}
function pttuan_custom_shortcode_slider_thumnail(){
add_ux_builder_shortcode( 'slider_thumnail', array(
    'type' => 'container',
    'name' => __( 'slider_thumnail' ),
    'category' => __( 'Layout' ),
    'message' => __( 'Add slides here' ),
    'directives' => array( 'ux-slider' ),
    'allow' => array( 'ux_banner','ux_image','section','row','ux_banner_grid','logo'),
    'template' => flatsome_ux_builder_template_pttuan( 'ux_slider.html' ),
    'thumbnail' =>  flatsome_ux_builder_thumbnail_pttuan( 'slider' ),
    'tools' => 'shortcodes/ux_slider/ux-slider-tools.directive.html',
    'wrap'   => false,
    'info' => '{{ label }}',
    'priority' => -1,
 
    'toolbar' => array(
        'show_children_selector' => true,
        'show_on_child_active' => true,
    ),
 
    'children' => array(
        'inline' => true,
        'addable_spots' => array( 'left', 'right' )
    ),
 
 
    'options' => array(
        'label' => array(
            'type' => 'textfield',
            'heading' => 'Admin label',
            'placeholder' => 'Enter admin label...'
        ),
        'type' => array(
          'type' => 'select',
          'heading' => 'Type',
          'default' => 'slide',
          'options' => array(
            'slide' => 'Slide',
          ),
        ),
        'layout_options' => array(
          'type' => 'group',
          'heading' => __( 'Layout' ),
          'options' => array(
            'style' => array(
              'type' => 'select',
              'heading' => 'Style',
              'default' => 'normal',
              'options' => array(
                  'normal' => 'Default',
                  'container' => 'Container',
                  'focus' => 'Focus',
                  'shadow' => 'Shadow',
              ),
              'conditions' => 'type !== "fade"',
            ),
            'slide_width' => array(
              'type' => 'scrubfield',
              'heading' => 'Slide Width',
              'placeholder' => 'Width in Px',
              'default' => '',
              'min' => '0',
              'conditions' => 'type !== "fade"',
            ),
 
            'slide_align' => array(
                'type' => 'select',
              'heading' => 'Slide Align',
              'default' => 'center',
              'options' => array(
                  'center' => 'Center',
                  'left' => 'Left',
                  'right' => 'Right',
              ),
              'conditions' => 'type !== "fade"',
            ),
            'bg_color' => array(
              'type' => 'colorpicker',
              'heading' => __('Bg Color'),
              'format' => 'rgb',
              'position' => 'bottom right',
              'helpers' => require( get_template_directory(). '/inc/builder/shortcodes/helpers/colors.php' ),
            ),
            'margin' => array(
              'type' => 'scrubfield',
              'responsive' => true,
              'heading' => __('Margin'),
              'default' => '0px',
              'min' => 0,
              'max' => 100,
              'step' => 1
            ),
            'infinitive' => array(
                'type' => 'radio-buttons',
                'heading' => __('Infinitive'),
                'default' => 'false',
                'options' => array(
                    'false'  => array( 'title' => 'Off'),
                    'true'  => array( 'title' => 'On'),
                ),
            ),
            'freescroll' => array(
                'type' => 'radio-buttons',
                'heading' => __('Free Scroll'),
                'default' => 'false',
                'options' => array(
                    'false'  => array( 'title' => 'Off'),
                    'true'  => array( 'title' => 'On'),
                ),
            ),
            'draggable' => array(
                'type' => 'radio-buttons',
                'heading' => __('Draggable'),
                'default' => 'true',
                'options' => array(
                    'false'  => array( 'title' => 'Off'),
                    'true'  => array( 'title' => 'On'),
                ),
            ),
            'parallax' => array(
                'type' => 'slider',
                'heading' => 'Parallax',
                'unit' => '+',
                'default' => 0,
                'max' => 10,
                'min' => 0,
            ),
            'mobile' => array(
                'type' => 'radio-buttons',
                'heading' => __('Show for Mobile'),
                'default' => 'true',
                'options' => array(
                    'false'  => array( 'title' => 'Off'),
                    'true'  => array( 'title' => 'On'),
                ),
            ),
          ),
        ),
 
        'nav_options' => array(
          'type' => 'group',
          'heading' => __( 'Navigation' ),
          'options' => array(
            'hide_nav' => array(
                'type' => 'radio-buttons',
                'heading' => __('Always Visible'),
                'default' => '',
                'options' => array(
                    ''  => array( 'title' => 'Off'),
                    'true'  => array( 'title' => 'On'),
                ),
            ),
            'nav_pos' => array(
              'type' => 'select',
              'heading' => 'Position',
              'default' => '',
              'options' => array(
                  '' => 'Inside',
                  'outside' => 'Outside',
              )
            ),
           'nav_size' => array(
              'type' => 'select',
              'heading' => 'Size',
              'default' => 'large',
              'options' => array(
                  'large' => 'Large',
                  'normal' => 'Normal',
              )
            ),
            'arrows' => array(
              'type' => 'radio-buttons',
              'heading' => __('Arrows'),
              'default' => 'true',
              'options' => array(
                'false'  => array( 'title' => 'Off'),
                'true'  => array( 'title' => 'On'),
                ),
            ),
            'nav_style' => array(
              'type' => 'select',
              'heading' => __('Arrow Style'),
              'default' => 'circle',
              'options' => array(
                  'circle' => 'Circle',
                  'simple' => 'Simple',
                  'reveal' => 'Reveal',
              )
            ),
            'nav_color' => array(
                'type' => 'radio-buttons',
                'heading' => __('Arrow Color'),
                'default' => 'light',
                'options' => array(
                    'dark'  => array( 'title' => 'Dark'),
                    'light'  => array( 'title' => 'Light'),
                ),
            ),
 
            'bullets' => array(
              'type' => 'radio-buttons',
              'heading' => __('Bullets'),
              'default' => 'false',
              'options' => array(
                  'false'  => array( 'title' => 'Off'),
                  'true'  => array( 'title' => 'On'),
              ),
            ),
            'bullet_style' => array(
              'type' => 'select',
              'heading' => 'Bullet Style',
              'default' => 'circle',
              'options' => array(
                'circle' => 'Circle',
                'dashes' => 'Dashes',
                'dashes-spaced' => 'Dashes (Spaced)',
                'simple' => 'Simple',
                'square' => 'Square',
            )
           ),
          ),
        ),
        'slide_options' => array(
          'type' => 'group',
          'heading' => __( 'Auto Slide' ),
          'options' => array(
            'auto_slide' => array(
                'type' => 'radio-buttons',
                'heading' => __('Auto slide'),
                'default' => 'true',
                'options' => array(
                    'false'  => array( 'title' => 'Off'),
                    'true'  => array( 'title' => 'On'),
                ),
            ),
            'timer' => array(
                'type' => 'textfield',
                'heading' => 'Timer (ms)',
                'default' => 6000,
            ),
            'pause_hover' => array(
                'type' => 'radio-buttons',
                'heading' => __('Pause on Hover'),
                'default' => 'true',
                'options' => array(
                    'false'  => array( 'title' => 'Off'),
                    'true'  => array( 'title' => 'On'),
                ),
            ),
          ),
        ),
            'advanced_options' => require( get_template_directory() . '/inc/builder/shortcodes/commons/advanced.php'),
    ),
) );
}
add_action('ux_builder_setup', 'pttuan_custom_shortcode_slider_thumnail');
function slider_thumnail( $atts, $content = null ){
  extract( shortcode_atts( array(
        '_id' => 'slider-'.rand(),
        'timer' => '6000',
        'bullets' => 'false',
        'visibility' => '',
        'class' => '',
        'type' => '',
        'bullet_style' => '',
        'auto_slide' => 'true',
        'auto_height' => 'true',
        'bg_color' => '',
        'slide_align' => 'center',
        'style' => 'normal',
        'slide_width' => '',
        'arrows' => 'true',
        'pause_hover' => 'true',
        'hide_nav' => '',
        'nav_style' => 'circle',
        'nav_color' => 'light',
        'nav_size' => 'large',
        'nav_pos' => '',
        'infinitive' => 'false',
        'freescroll' => 'false',
        'parallax' => '0',
        'margin' => '',
        'columns' => '1',
        'height' => '',
        'rtl' => 'false',
        'draggable' => 'true',
        'friction' => '0.6',
        'selectedattraction' => '0.1',
        'threshold' => '10',
        'class_slider' => '',
        // Derpicated
        'mobile' => 'true',
 
    ), $atts ) );
 
    // Stop if visibility is hidden
    if($visibility == 'hidden') return;
    if($mobile !==  'true' && !$visibility) {$visibility = 'hide-for-small';}
 
    ob_start();
 
    $wrapper_classes = array('slider-wrapper', 'relative');
    if( $class ) $wrapper_classes[] = $class;
    if( $visibility ) $wrapper_classes[] = $visibility;
    $wrapper_classes = implode(" ", $wrapper_classes);
 
    $classes = array('slider');
 
    if ($type == 'fade') $classes[] = 'slider-type-'.$type;
 
    // Bullet style
    if($bullet_style) $classes[] = 'slider-nav-dots-'.$bullet_style;
 
    // Nav style
    if($nav_style) $classes[] = 'slider-nav-'.$nav_style;
 
    // Nav size
    if($nav_size) $classes[] = 'slider-nav-'.$nav_size;
 
    // Nav Color
    if($nav_color) $classes[] = 'slider-nav-'.$nav_color;
 
    // Nav Position
    if($nav_pos) $classes[] = 'slider-nav-'.$nav_pos;
 
    // Add timer
    if($auto_slide == 'true') $auto_slide = $timer;
 
    // Add Slider style
    if($style) $classes[] = 'slider-style-'.$style;
    // Always show Nav if set
    if($hide_nav ==  'true') {$classes[] = 'slider-show-nav';}
 
    // Slider Nav visebility
    $is_arrows = 'true';
    $is_bullets = 'true';
 
    if($arrows == 'false') $is_arrows = 'false';
    if($bullets == 'false') $is_bullets = 'false';
 
    if(is_rtl()) $rtl = 'true';
 
    $classes = implode(" ", $classes);
 
    // Inline CSS
    $css_args = array(
        'bg_color' => array(
          'attribute' => 'background-color',
          'value' => $bg_color,
        ),
        'margin' => array(
          'attribute' => 'margin-bottom',
          'value' => $margin,
        )
    );
?>
<div class="<?php echo $wrapper_classes; ?>" id="<?php echo $_id; ?>" <?php echo get_shortcode_inline_css($css_args); ?>>
    <div class="<?php echo $classes; ?> <?php echo $_id; ?>"
        data-flickity-options='{
            
            "cellAlign": "<?php echo $slide_align; ?>",
            "imagesLoaded": true,
            "lazyLoad": 1,
            "freeScroll": <?php echo $freescroll; ?>,
            "wrapAround": <?php echo $infinitive; ?>,
            "autoPlay": <?php echo $auto_slide;?>,
            "pauseAutoPlayOnHover" : <?php echo $pause_hover; ?>,
            "prevNextButtons": <?php echo $is_arrows; ?>,
            "contain" : true,
            "adaptiveHeight" : <?php echo $auto_height;?>,
            "dragThreshold" : <?php echo $threshold ;?>,
            "percentPosition": true,
            "pageDots": <?php echo $is_bullets; ?>,
            "rightToLeft": <?php echo $rtl; ?>,
            "draggable": <?php echo $draggable; ?>,
            "selectedAttraction": <?php echo $selectedattraction; ?>,
            "parallax" : <?php echo $parallax; ?>,
            "friction": <?php echo $friction; ?>
        }'
        >
        <?php echo do_shortcode($content); ?>
    </div>
    <div class="slider-custom <?php echo $classes; ?> "
        data-flickity-options='{
            "asNavFor": "<?php echo '.'.$_id;?>",
            "cellAlign": "<?php echo $slide_align; ?>",
            "imagesLoaded": true,
            "lazyLoad": 1,
            "freeScroll": <?php echo $freescroll; ?>,
            "wrapAround": <?php echo $infinitive; ?>,
            "autoPlay": <?php echo $auto_slide;?>,
            "pauseAutoPlayOnHover" : <?php echo $pause_hover; ?>,
            "prevNextButtons": <?php echo $is_arrows; ?>,
            "contain" : true,
            "adaptiveHeight" : <?php echo $auto_height;?>,
            "dragThreshold" : <?php echo $threshold ;?>,
            "percentPosition": true,
            "pageDots": <?php echo $is_bullets; ?>,
            "rightToLeft": <?php echo $rtl; ?>,
            "draggable": <?php echo $draggable; ?>,
            "selectedAttraction": <?php echo $selectedattraction; ?>,
            "parallax" : <?php echo $parallax; ?>,
            "friction": <?php echo $friction; ?>
        }'
        >
        <?php echo do_shortcode($content); ?>
    </div>
     <div class="loading-spin dark large centered"></div>
 
     <style scope="scope">
        .slider-custom{
            padding: 0 50px;
            bottom: 120px;
 
        }
        .slider-custom .flickity-slider .img{
            max-width: 20%!important;
                margin: 5px;
                border: 2px solid #fff;
        }
        <?php if($slide_width) { ?>
            #<?php echo $_id; ?> .flickity-slider > *{ max-width: <?php echo $slide_width; ?>!important;
         <?php } ?>
     </style>
</div><!-- .ux-slider-wrapper -->
 
<?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('slider_thumnail', 'slider_thumnail');

function namanh_enqueue_scripts() {
	// Nạp script của bạn
	wp_enqueue_script(
		'namanh-custom-js', // Tên handle
		get_stylesheet_directory_uri() . '/namanh.js', // Đường dẫn file JS
		array(), // Không phụ thuộc file nào
		'1.0', // Phiên bản
		true // true = load ở footer
	);

	// -------------------------------------------------------
	// AOS (Animate On Scroll) - CSS & JS
	// -------------------------------------------------------

	// 1. Đăng ký và đưa vào hàng đợi AOS CSS
	wp_enqueue_style(
		'aos-css',                                        // Handle
		get_stylesheet_directory_uri() . '/css/aos.css', // Đường dẫn file CSS
		array(),                                          // Không phụ thuộc style nào
		'2.3.4'                                           // Phiên bản AOS
	);

	// 2. Đăng ký và đưa vào hàng đợi AOS JS
	wp_enqueue_script(
		'aos-js',                                        // Handle
		get_stylesheet_directory_uri() . '/js/aos.js',  // Đường dẫn file JS
		array(),                                         // Không phụ thuộc script nào
		'2.3.4',                                         // Phiên bản AOS
		true                                             // Load ở footer
	);

	// 3. Khởi tạo AOS bằng inline script sau khi file JS được tải
	$aos_init_script = "
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration : 800,           // Thời gian animation (ms)
        easing   : 'ease-in-out', // Kiểu easing
        once     : true,          // Chỉ chạy animation 1 lần khi scroll xuống
        offset   : 120            // Khoảng cách (px) từ đáy viewport để kích hoạt
    });
});
	";
	wp_add_inline_script( 'aos-js', $aos_init_script );

	// -------------------------------------------------------
	// Phân trang Load More cho trang Dự án
	// Truyền biến PHP sang JavaScript
	// -------------------------------------------------------
	wp_localize_script( 'namanh-custom-js', 'namanhVars', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
	) );
}
add_action('wp_enqueue_scripts', 'namanh_enqueue_scripts');

// Thêm meta box nhập địa chỉ cho post type featured_item
function add_featured_item_address_metabox() {
	add_meta_box(
		'featured_item_address',
		'Địa chỉ dự án',
		'featured_item_address_callback',
		'featured_item',
		'normal',
		'default'
	);
}
add_action('add_meta_boxes', 'add_featured_item_address_metabox');

function featured_item_address_callback($post) {
	$address = get_post_meta($post->ID, '_featured_item_address', true);
	echo '<label for="featured_item_address_field">Nhập địa chỉ dự án:</label><br>';
	echo '<input type="text" id="featured_item_address_field" name="featured_item_address_field" value="' . esc_attr($address) . '" style="width:100%;"/>';
}

// Lưu dữ liệu khi cập nhật bài
function save_featured_item_address($post_id) {
	if (array_key_exists('featured_item_address_field', $_POST)) {
		update_post_meta(
			$post_id,
			'_featured_item_address',
			sanitize_text_field($_POST['featured_item_address_field'])
		);
	}
}
add_action('save_post', 'save_featured_item_address');

//Import Google Font
function add_google_fonts() {
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

add_action( 'woocommerce_single_product_summary', 'custom_display_sku_below_title', 6 );
function custom_display_sku_below_title() {
    global $product;
    if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) {
        ?>
        <div class="product_meta custom-sku" style="margin-bottom: 10px;">
            <span class="sku_wrapper"><?php esc_html_e( 'Mã sản phẩm:', 'woocommerce' ); ?> 
                <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span>
            </span>
        </div>
        <?php
    }
}
// Thêm meta box cho Product để nhập link VR và link Đặt hàng
function add_product_custom_links_metabox() {
    add_meta_box(
        'product_custom_links',
        'Cấu hình Button Sản phẩm',
        'product_custom_links_callback',
        'product',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_product_custom_links_metabox');

function product_custom_links_callback($post) {
    $vr_link = get_post_meta($post->ID, '_product_vr_link', true);
    $order_link = get_post_meta($post->ID, '_product_order_now_link', true);
    
    echo '<p><label for="product_vr_link_field">Link xem sản phẩm trong không gian (VR):</label><br>';
    echo '<input type="text" id="product_vr_link_field" name="product_vr_link_field" value="' . esc_attr($vr_link) . '" style="width:100%;" placeholder="https://..."/></p>';
    
    echo '<p><label for="product_order_now_link_field">Link Đặt hàng ngay:</label><br>';
    echo '<input type="text" id="product_order_now_link_field" name="product_order_now_link_field" value="' . esc_attr($order_link) . '" style="width:100%;" placeholder="https://..."/></p>';
}

function save_product_custom_links($post_id) {
    if (array_key_exists('product_vr_link_field', $_POST)) {
        update_post_meta($post_id, '_product_vr_link', sanitize_text_field($_POST['product_vr_link_field']));
    }
    if (array_key_exists('product_order_now_link_field', $_POST)) {
        update_post_meta($post_id, '_product_order_now_link', sanitize_text_field($_POST['product_order_now_link_field']));
    }
}
add_action('save_post', 'save_product_custom_links');

// Hiển thị 2 button Đặt hàng và Xem sản phẩm trong không gian
add_action('woocommerce_single_product_summary', 'namanh_display_custom_product_buttons', 25);
function namanh_display_custom_product_buttons() {
    global $post;
    $vr_link = get_post_meta($post->ID, '_product_vr_link', true);
    $order_link = get_post_meta($post->ID, '_product_order_now_link', true);

    if (!$vr_link && !$order_link) return;

    echo '<div class="custom-product-buttons">';
    
    if ($vr_link) {
        echo '<a href="' . esc_url($vr_link) . '" class="btn-custom btn-vr">';
        echo '<span>Xem sản phẩm trong không gian của bạn</span>';
        echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 10px;">
                <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>';
        echo '</a>';

    }

    if ($order_link) {
        echo '<a href="' . esc_url($order_link) . '" class="btn-custom btn-order-now" target="_blank">';
        echo 'ĐẶT HÀNG NGAY';
        echo '</a>';
    }
    echo '</div>';
}

/**
 * Custom Widget for Sidebar Latest Posts
 */
class Namanh_Recent_Posts_Widget extends WP_Widget {
    function __construct() {
        parent::__construct('namanh_recent_posts', 'Namanh Recent Posts', array('description' => 'Hiển thị bài viết mới nhất với Ngày và Chuyên mục cho sidebar'));
    }

    function widget($args, $instance) {
        $title = apply_filters('widget_title', empty($instance['title']) ? 'Bài viết mới nhất' : $instance['title']);
        $number = !empty($instance['number']) ? $instance['number'] : 5;

        echo $args['before_widget'];
        if ($title) echo $args['before_title'] . $title . $args['after_title'];

        $q = new WP_Query(array(
            'posts_per_page' => $number,
            'post_status' => 'publish',
            'ignore_sticky_posts' => true
        ));

        if ($q->have_posts()) {
            echo '<ul class="namanh-recent-posts">';
            while ($q->have_posts()) {
                $q->the_post();
                ?>
                <li class="namanh-recent-post-item">
                    <a class="post-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <div class="custom-post-meta">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px; vertical-align: middle; margin-top: -2px; opacity: 0.8;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <span class="post-date"><?php echo get_the_date('d/m/Y'); ?></span>
                        <?php if (get_the_category()) : ?>
                            <span class="meta-separator">|</span>
                            <span class="post-categories"><?php echo get_the_category_list(',&nbsp;'); ?></span>
                        <?php endif; ?>
                    </div>
                </li>
                <?php
            }
            echo '</ul>';
            wp_reset_postdata();
        }
        echo $args['after_widget'];
    }

    function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'Bài viết mới nhất';
        $number = !empty($instance['number']) ? $instance['number'] : 5;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Tiêu đề:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>">Số lượng bài viết:</label>
            <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" value="<?php echo esc_attr($number); ?>" size="3">
        </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['number'] = (int) $new_instance['number'];
        return $instance;
    }
}

add_action('widgets_init', function() {
    register_widget('Namanh_Recent_Posts_Widget');
});

// Override flatsome_posted_on to match the design: [Icon] Date | Category
if ( ! function_exists( 'flatsome_posted_on' ) ) {
    function flatsome_posted_on() {
        $date = get_the_date('d/m/Y');
        $categories = get_the_category_list(__( ', ', 'flatsome' ));
        
        $calendar_icon = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 5px; margin-top: -3px;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>';

        echo '<span class="custom-post-meta">';
        echo $calendar_icon . '<span class="post-date">' . $date . '</span>';
        if ( $categories && !is_wp_error($categories) ) {
            echo ' <span class="meta-separator">|</span> <span class="post-categories">' . str_replace(', ', ',&nbsp;', $categories) . '</span>';
        }
        echo '</span>';
    }
}

// Thêm link < Tin tức vào trên cùng bài viết chi tiết
add_action( 'flatsome_before_blog', 'namanh_add_back_to_news_link', 5 );
function namanh_add_back_to_news_link() {
    if ( is_single() && get_post_type() === 'post' ) {
        echo '<div class="back-to-category-wrapper container">';
        echo '<a href="' . home_url( '/tin-tuc/' ) . '" class="back-to-category"><span class="arrow"><</span> <span class="text">Tin tức</span></a>';
        echo '</div>';
    }
}

// Redirect category links to /tin-tuc/ or /du-an/ tabs
add_filter( 'term_link', 'namanh_custom_category_link', 10, 3 );
function namanh_custom_category_link( $url, $term, $taxonomy ) {
    // Xử lý Chuyên mục bài viết (Tin tức)
    if ( $taxonomy === 'category' ) {
        $mapping = array(
            'tin-tuc'          => '',
            'cam-nang'         => 'tab_cẩm-nang',
            'giai-thuong'      => 'tab_giải-thưởng',
            'hoat-dong-xa-hoi' => 'tab_hoạt-động-xã-hội',
            'su-kien'          => 'tab_sự-kiện',
        );

        if ( array_key_exists( $term->slug, $mapping ) ) {
            $hash = $mapping[$term->slug];
            $new_url = home_url( '/tin-tuc/' );
            if ( $hash ) $new_url .= '#' . $hash;
            return $new_url;
        }
    }

    // Xử lý Danh mục dự án (Dự án)
    if ( $taxonomy === 'featured_item_category' ) {
        $mapping = array(
            'thiet-ke-noi-that'         => 'tab_thiết-kế-nội-thất',
            'thi-cong-noi-that'         => 'tab_thi-công-nội-thất',
            'chung-cu'                  => 'tab_chung-cư',
            'chung-cu-thi-cong-noi-that' => 'tab_chung-cư',
            'biet-thu'                  => 'tab_biệt-thự',
            'biet-thu-thi-cong-noi-that' => 'tab_biệt-thự',
            'nha-pho'                   => 'tab_nhà-phố',
            'nha-pho-thi-cong-noi-that'   => 'tab_nhà-phố',
        );

        if ( array_key_exists( $term->slug, $mapping ) ) {
            $hash = $mapping[$term->slug];
            $new_url = home_url( '/du-an/' );
            if ( $hash ) $new_url .= '#' . $hash;
            return $new_url;
        }
    }

    return $url;
}

// 301 redirect from category archive to custom page/tab
add_action( 'template_redirect', 'namanh_redirect_category_to_page' );
function namanh_redirect_category_to_page() {
    if ( is_category() || is_tax('featured_item_category') ) {
        $term = get_queried_object();
        
        $mapping = array(
            'tin-tuc'                    => array('page' => '/tin-tuc/', 'hash' => ''),
            'cam-nang'                   => array('page' => '/tin-tuc/', 'hash' => 'tab_cẩm-nang'),
            'giai-thuong'                => array('page' => '/tin-tuc/', 'hash' => 'tab_giải-thưởng'),
            'hoat-dong-xa-hoi'           => array('page' => '/tin-tuc/', 'hash' => 'tab_hoạt-động-xã-hội'),
            'su-kien'                    => array('page' => '/tin-tuc/', 'hash' => 'tab_sự-kiện'),
            'thiet-ke-noi-that'          => array('page' => '/du-an/', 'hash' => 'tab_thiết-kế-nội-thất'),
            'thi-cong-noi-that'          => array('page' => '/du-an/', 'hash' => 'tab_thi-công-nội-thất'),
            'chung-cu'                   => array('page' => '/du-an/', 'hash' => 'tab_chung-cư'),
            'chung-cu-thi-cong-noi-that'  => array('page' => '/du-an/', 'hash' => 'tab_chung-cư'),
            'biet-thu'                   => array('page' => '/du-an/', 'hash' => 'tab_biệt-thự'),
            'biet-thu-thi-cong-noi-that'  => array('page' => '/du-an/', 'hash' => 'tab_biệt-thự'),
            'nha-pho'                    => array('page' => '/du-an/', 'hash' => 'tab_nhà-phố'),
            'nha-pho-thi-cong-noi-that'   => array('page' => '/du-an/', 'hash' => 'tab_nhà-phố'),
        );

        if ( isset($term->slug) && array_key_exists( $term->slug, $mapping ) ) {
            $data = $mapping[$term->slug];
            $url = home_url( $data['page'] );
            if ( $data['hash'] ) {
                $url .= '#' . $data['hash'];
            }
            wp_redirect( $url, 301 );
            exit;
        }
    }
}

// Đổi tên tab Description thành MÔ TẢ CHUNG
add_filter( 'woocommerce_product_tabs', 'namanh_rename_description_tab', 98 );
function namanh_rename_description_tab( $tabs ) {
    if ( isset( $tabs['description'] ) ) {
        $tabs['description']['title'] = 'MÔ TẢ CHUNG';
    }
    return $tabs;
}

// Đổi tiêu đề Description Heading bên trong nội dung tab
add_filter( 'woocommerce_product_description_heading', 'namanh_rename_description_heading' );
function namanh_rename_description_heading() {
    return 'MÔ TẢ CHUNG';
}

// Thêm link Danh sách sản phẩm quay về category
add_action( 'woocommerce_before_single_product', 'namanh_add_back_to_category_link', 15 );
function namanh_add_back_to_category_link() {
    global $product;
    if ( ! is_a( $product, 'WC_Product' ) ) {
        return;
    }
    
    $terms = get_the_terms( $product->get_id(), 'product_cat' );
    
    if ( $terms && ! is_wp_error( $terms ) ) {
        // Ưu tiên lấy category con nhất hoặc category đầu tiên
        $main_term = $terms[0];
        $link = get_term_link( $main_term );
        
        echo '<div class="back-to-category-wrapper">';
        echo '<a href="' . esc_url( $link ) . '" class="back-to-category"><span class="arrow"><</span> <span class="text">Danh sách sản phẩm</span></a>';
        echo '</div>';
    }
}

// Thêm Header mobile (Title và SKU) nằm trên Gallery
add_action( 'woocommerce_before_single_product', 'namanh_mobile_product_header', 20 );
function namanh_mobile_product_header() {
    global $product;
    if ( ! is_a( $product, 'WC_Product' ) ) {
        return;
    }
    ?>
    <div class="mobile-product-header">
        <h1 class="product_title entry-title"><?php the_title(); ?></h1>
        <?php custom_display_sku_below_title(); ?>
    </div>
    <?php
}

// Hiển thị SKU bên dưới tên sản phẩm ở trang danh mục (Shop loop)
add_action( 'woocommerce_after_shop_loop_item_title', 'namanh_display_sku_in_loop', 2 );
function namanh_display_sku_in_loop() {
    global $product;
    if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) {
        $sku = $product->get_sku();
        if ( ! $sku ) {
            $sku = __( 'N/A', 'woocommerce' );
        }
        echo '<div class="shop-loop-sku">';
        echo '<span class="sku_wrapper">' . esc_html__( 'Mã:', 'woocommerce' ) . ' <span class="sku">' . esc_html( $sku ) . '</span></span>';
        echo '</div>';
    }
}

// Hiển thị nội dung "Shop Page Header" bên trên khối tiêu đề trang
add_action('flatsome_after_header', 'namanh_display_shop_header_on_categories', 10);
function namanh_display_shop_header_on_categories() {
    // Chạy trên trang Shop, Danh mục sản phẩm hoặc Tag sản phẩm
    if ( is_shop() || is_product_category() || is_product_tag() ) {
        // Lấy nội dung từ Theme Mod "Shop Page Header" của Flatsome
        $shop_header = get_theme_mod('html_shop_page_content');
        
        // Fallback nếu không lấy được theme mod (dựa trên screenshot của bạn)
        if ( ! $shop_header ) {
             $shop_header = '<div class="back-to-category-wrapper"><a href="/san-pham" class="back-to-category"><span class="arrow"><</span><span class="text">Sản phẩm</span></a></div>';
        }

        if ( $shop_header ) {
            echo '<div class="category-custom-header-wrapper container">' . do_shortcode($shop_header) . '</div>';
        }
    }
}

// Thay đổi placeholder cho ô tìm kiếm sản phẩm sang "Tìm kiếm"
add_filter( 'theme_mod_search_placeholder', 'namanh_custom_search_placeholder' );
function namanh_custom_search_placeholder( $value ) {
    return 'Tìm kiếm';
}

// Đảm bảo các chuỗi "Search" trong WooCommerce được dịch sang "Tìm kiếm"
add_filter( 'gettext', 'namanh_change_search_text', 20, 3 );
function namanh_change_search_text( $translated_text, $text, $domain ) {
    if ( $domain == 'woocommerce' && $text == 'Search' ) {
        return 'Tìm kiếm';
    }
    return $translated_text;
}

// Thêm Text và Icon "Bộ lọc" trên đầu sidebar
add_action( 'dynamic_sidebar_before', 'namanh_add_filter_title_before_sidebar', 10, 2 );
function namanh_add_filter_title_before_sidebar( $index, $has_widgets ) {
    if ( 'shop-sidebar' === $index ) {
        echo '<div class="custom-sidebar-filter-title">';
        echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="filter-icon"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>';
        echo '<span>Bộ lọc</span>';
        echo '</div>';
    }
}

// Đưa thanh tìm kiếm ra ngoài sidebar, đặt dưới tiêu đề danh mục
add_action('woocommerce_archive_description', 'namanh_add_search_to_category_header', 15);
function namanh_add_search_to_category_header() {
    if ( is_product_category() || is_shop() ) {
        echo '<div class="category-search-wrapper" style="max-width: 286px; margin: 0 auto 20px; padding: 0 15px;">';
        get_product_search_form();
        echo '</div>';
    }
}

// Tắt bình luận trên trang bài viết chi tiết
add_filter('comments_open', 'namanh_disable_comments', 20, 2);
function namanh_disable_comments($open, $post_id) {
    if (is_single()) {
        return false;
    }
    return $open;
}

// Ẩn các bình luận đã có
add_filter('comments_array', 'namanh_hide_existing_comments', 10, 2);
function namanh_hide_existing_comments($comments, $post_id) {
    if (is_single()) {
        return array();
    }
    return $comments;
}

// Hiển thị bài viết liên quan ở cuối bài viết chi tiết (Full width)
add_action('flatsome_after_blog', 'namanh_display_related_posts_full_width');
function namanh_display_related_posts_full_width() {
    if (!is_single() || get_post_type() !== 'post') return;

    $categories = get_the_category();
    if (!$categories) return;

    $cat_ids = array();
    foreach($categories as $cat) {
        $cat_ids[] = $cat->term_id;
    }
    $cat_str = implode(',', $cat_ids);

    echo '<div class="related-posts-container container" style="margin-top: 30px; margin-bottom: 30px; clear: both;">';
    echo '<h3 class="related-posts-section-title title-underline"><span>TIN TỨC LIÊN QUAN</span></h3>';
    echo do_shortcode('[blog_posts cat="'.$cat_str.'" class="tin-tuc-listing" style="normal" columns="3" columns__md="1" posts="3" image_height="56%" show_date="text" excerpt="false" show_category="true"]');
    echo '</div>';
}

// Override [blog_posts] shortcode to customize category separator
function namanh_shortcode_latest_from_blog($atts, $content = null, $tag = '' ) {

	extract(shortcode_atts(array(
		"_id" => 'row-'.rand(),
		'style' => '',
		'class' => '',
		'visibility' => '',

		// Layout
		"columns" => '4',
		"columns__sm" => '1',
		"columns__md" => '',
		'col_spacing' => '',
		"type" => 'slider', // slider, row, masonery, grid
		'width' => '',
		'grid' => '1',
		'grid_height' => '600px',
		'grid_height__md' => '500px',
		'grid_height__sm' => '400px',
		'slider_nav_style' => 'reveal',
		'slider_nav_position' => '',
		'slider_nav_color' => '',
		'slider_bullets' => 'false',
	 	'slider_arrows' => 'true',
		'auto_slide' => 'false',
		'infinitive' => 'true',
		'depth' => '',
   		'depth_hover' => '',

		// posts
		'posts' => '8',
		'ids' => false, // Custom IDs
		'cat' => '',
		'category' => '', // Added for Flatsome v2 fallback
		'excerpt' => 'visible',
		'excerpt_length' => 15,
		'offset' => '',
		'orderby' => 'date',
		'order' => 'DESC',

		// Read more
		'readmore' => '',
		'readmore_color' => '',
		'readmore_style' => 'outline',
		'readmore_size' => 'small',

		// div meta
		'post_icon' => 'true',
		'comments' => 'true',
		'show_date' => 'badge', // badge, text
		'badge_style' => '',
		'show_category' => 'false',

		//Title
		'title_size' => 'large',
		'title_style' => '',

		// Box styles
		'animate' => '',
		'text_pos' => 'bottom',
	  	'text_padding' => '',
	  	'text_bg' => '',
	  	'text_size' => '',
	 	'text_color' => '',
	 	'text_hover' => '',
	 	'text_align' => 'center',
	 	'image_size' => 'medium',
	 	'image_width' => '',
	 	'image_radius' => '',
	 	'image_height' => '56%',
	    'image_hover' => '',
	    'image_hover_alt' => '',
	    'image_overlay' => '',
	    'image_depth' => '',
	    'image_depth_hover' => '',

	), $atts));

	// Stop if visibility is hidden
  if($visibility == 'hidden') return;

	ob_start();

	$classes_box = array();
	$classes_image = array();
	$classes_text = array();

	// Fix overlay color
    if($style == 'text-overlay'){
      $image_hover = 'zoom';
    }
    $style = str_replace('text-', '', $style);

	// Fix grids
	if($type == 'grid'){
	  if(!$text_pos) $text_pos = 'center';
	  $columns = 0;
	  $current_grid = 0;
	  $grid = flatsome_get_grid($grid);
	  $grid_total = count($grid);
	  flatsome_get_grid_height($grid_height, $_id);
	}

	// Fix overlay
	if($style == 'overlay' && !$image_overlay) $image_overlay = 'rgba(0,0,0,.25)';

	// Set box style
	if($style) $classes_box[] = 'box-'.$style;
	if($style == 'overlay') $classes_box[] = 'dark';
	if($style == 'shade') $classes_box[] = 'dark';
	if($style == 'badge') $classes_box[] = 'hover-dark';
	if($text_pos) $classes_box[] = 'box-text-'.$text_pos;

	if($image_hover)  $classes_image[] = 'image-'.$image_hover;
	if($image_hover_alt)  $classes_image[] = 'image-'.$image_hover_alt;
	if($image_height) $classes_image[] = 'image-cover';

	// Text classes
	if($text_hover) $classes_text[] = 'show-on-hover hover-'.$text_hover;
	if($text_align) $classes_text[] = 'text-'.$text_align;
	if($text_size) $classes_text[] = 'is-'.$text_size;
	if($text_color == 'dark') $classes_text[] = 'dark';

	$css_args_img = array(
	  array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => '%' ),
	  array( 'attribute' => 'width', 'value' => $image_width, 'unit' => '%' ),
	);

	$css_image_height = array(
      array( 'attribute' => 'padding-top', 'value' => $image_height),
  	);

	$css_args = array(
      array( 'attribute' => 'background-color', 'value' => $text_bg ),
      array( 'attribute' => 'padding', 'value' => $text_padding ),
  	);

    // Add Animations
	if($animate) {$animate = 'data-animate="'.$animate.'"';}

	$classes_text = implode(' ', $classes_text);
	$classes_image = implode(' ', $classes_image);
	$classes_box = implode(' ', $classes_box);

	// Repeater styles
	$repeater['id'] = $_id;
	$repeater['tag'] = $tag;
	$repeater['type'] = $type;
	$repeater['class'] = $class;
	$repeater['visibility'] = $visibility;
	$repeater['style'] = $style;
	$repeater['slider_style'] = $slider_nav_style;
	$repeater['slider_nav_position'] = $slider_nav_position;
	$repeater['slider_nav_color'] = $slider_nav_color;
	$repeater['slider_bullets'] = $slider_bullets;
    $repeater['auto_slide'] = $auto_slide;
	$repeater['infinitive'] = $infinitive;
	$repeater['row_spacing'] = $col_spacing;
	$repeater['row_width'] = $width;
	$repeater['columns'] = $columns;
	$repeater['columns__md'] = $columns__md;
	$repeater['columns__sm'] = $columns__sm;
	$repeater['depth'] = $depth;
	$repeater['depth_hover'] = $depth_hover;

	$args = array(
		'post_status' => 'publish',
		'post_type' => 'post',
		'offset' => $offset,
		'cat' => $cat,
		'posts_per_page' => $posts,
		'ignore_sticky_posts' => true,
		'orderby'             => $orderby,
		'order'               => $order,
	);

	// Added for Flatsome v2 fallback
	if ( get_theme_mod('flatsome_fallback', 0) && $category ) {
		$args['category_name'] = $category;
	}

	// If custom ids
	if ( !empty( $ids ) ) {
		$ids = explode( ',', $ids );
		$ids = array_map( 'trim', $ids );

		$args = array(
			'post__in' => $ids,
            'post_type' => array(
                'post',
                'featured_item', // Include for its tag archive listing.
            ),
			'numberposts' => -1,
			'orderby' => 'post__in',
			'posts_per_page' => 9999,
			'ignore_sticky_posts' => true,
		);

		// Include for search archive listing.
		if ( is_search() ) {
			$args['post_type'][] = 'page';
		}
	}

$recentPosts = new WP_Query( $args );

// Get repeater HTML.
get_flatsome_repeater_start($repeater);

while ( $recentPosts->have_posts() ) : $recentPosts->the_post();

			$col_class    = array( 'post-item' );
			$show_excerpt = $excerpt;

			if(get_post_format() == 'video') $col_class[] = 'has-post-icon';

			if($type == 'grid'){
	        if($grid_total > $current_grid) $current_grid++;
	        $current = $current_grid-1;

	        $col_class[] = 'grid-col';
	        if($grid[$current]['height']) $col_class[] = 'grid-col-'.$grid[$current]['height'];

	        if($grid[$current]['span']) $col_class[] = 'large-'.$grid[$current]['span'];
	        if($grid[$current]['md']) $col_class[] = 'medium-'.$grid[$current]['md'];

	        // Set image size
	        if($grid[$current]['size']) $image_size = $grid[$current]['size'];

	        // Hide excerpt for small sizes
	        if($grid[$current]['size'] == 'thumbnail') $show_excerpt = 'false';
	    }

		?><div class="col <?php echo implode(' ', $col_class); ?>" <?php echo $animate;?>>
			<div class="col-inner">
			<a href="<?php the_permalink() ?>" class="plain">
				<div class="box <?php echo $classes_box; ?> box-blog-post has-hover">
          <?php if(has_post_thumbnail()) { ?>
  					<div class="box-image" <?php echo get_shortcode_inline_css($css_args_img); ?>>
  						<div class="<?php echo $classes_image; ?>" <?php echo get_shortcode_inline_css($css_image_height); ?>>
  							<?php the_post_thumbnail($image_size); ?>
  							<?php if($image_overlay){ ?><div class="overlay" style="background-color: <?php echo $image_overlay;?>"></div><?php } ?>
  							<?php if($style == 'shade'){ ?><div class="shade"></div><?php } ?>
  						</div>
  						<?php if($post_icon && get_post_format()) { ?>
  							<div class="absolute no-click x50 y50 md-x50 md-y50 lg-x50 lg-y50">
  				            	<div class="overlay-icon">
  				                    <i class="icon-play"></i>
  				                </div>
  				            </div>
  						<?php } ?>
  					</div>
          <?php } ?>
					<div class="box-text <?php echo $classes_text; ?>" <?php echo get_shortcode_inline_css($css_args); ?>>
					<div class="box-text-inner blog-post-inner">

					<?php do_action('flatsome_blog_post_before'); ?>

					<?php if($show_category !== 'false') { ?>
						<p class="cat-label <?php if($show_category == 'label') echo 'tag-label'; ?> is-xxsmall op-7 uppercase">
					<?php
						echo str_replace(', ', ',&nbsp;', get_the_category_list( ', ' ));
					?>
					</p>
					<?php } ?>
					<h5 class="post-title is-<?php echo $title_size; ?> <?php echo $title_style;?>"><?php the_title(); ?></h5>
					<?php if((!has_post_thumbnail() && $show_date !== 'false') || $show_date == 'text') {?><div class="post-meta is-small op-8"><?php echo get_the_date(); ?></div><?php } ?>
					<div class="is-divider"></div>
					<?php if($show_excerpt !== 'false') { ?>
					<p class="from_the_blog_excerpt <?php if($show_excerpt !== 'visible'){ echo 'show-on-hover hover-'.$show_excerpt; } ?>"><?php
					  $the_excerpt  = strip_tags(get_the_excerpt());
					  // Giới hạn excerpt khoảng 250 ký tự để đảm bảo layout đẹp
					  echo mb_strimwidth($the_excerpt, 0, 250, "...");
					?>
					</p>
					<?php } ?>
                    <?php if ( $comments == 'true' && comments_open() && '0' != get_comments_number() ) { ?>
                        <p class="from_the_blog_comments uppercase is-xsmall">
                            <?php
                                $comments_number = get_comments_number( get_the_ID() );
                            	/* translators: %s: comment count */
                                printf( _n( '%s Comment', '%s Comments', $comments_number, 'flatsome' ),
                                    number_format_i18n( $comments_number ) )
                            ?>
                        </p>
                    <?php } ?>

					<?php if($readmore) { ?>
						<button href="<?php echo get_the_permalink(); ?>" class="button <?php echo $readmore_color; ?> is-<?php echo $readmore_style; ?> is-<?php echo $readmore_size; ?> mb-0">
							<?php echo $readmore ;?>
						</button>
					<?php } ?>

					<?php do_action('flatsome_blog_post_after'); ?>

					</div>
					</div>
					<?php if(has_post_thumbnail() && ($show_date == 'badge' || $show_date == 'true')) {?>
					<?php if(!$badge_style) $badge_style = get_theme_mod('blog_badge_style', 'outline'); ?>
						<div class="badge absolute top post-date badge-<?php echo $badge_style; ?>">
							<div class="badge-inner">
								<span class="post-date-day"><?php echo get_the_time('d', get_the_ID()); ?></span><br>
								<span class="post-date-month is-xsmall"><?php echo get_the_time('M', get_the_ID()); ?></span>
							</div>
						</div>
					<?php } ?>
				</div>
				</a>
			</div>
		</div><?php endwhile;
wp_reset_query();

// Get repeater end.
get_flatsome_repeater_end($atts);

$content = ob_get_contents();
ob_end_clean();
return $content;
}

add_action('init', function() {
    remove_shortcode('blog_posts');
    add_shortcode('blog_posts', 'namanh_shortcode_latest_from_blog');
});

// ============================================================
// PHÂN TRANG DỰ ÁN – LOAD MORE (AJAX)
// Override shortcode [ux_portfolio] để thêm tính năng Load More
// ============================================================

/**
 * Bước 1: Ghi đè shortcode [ux_portfolio] của Flatsome.
 * Hook 'init' priority 20 để đảm bảo Flatsome đã đăng ký trước.
 */
add_action( 'init', 'namanh_override_ux_portfolio_shortcode', 20 );
function namanh_override_ux_portfolio_shortcode() {
	remove_shortcode( 'ux_portfolio' );
	add_shortcode( 'ux_portfolio', 'namanh_portfolio_with_loadmore' );
}

/**
 * Bước 2: Shortcode [ux_portfolio] mới – hỗ trợ phân trang Load More.
 *
 * Thuộc tính mới:
 *   per_page="6"  – số item hiển thị ban đầu (mặc định 6)
 *
 * Luồng hoạt động:
 *   1. Đếm tổng số item theo đúng bộ lọc (cat, ids, exclude)
 *   2. Render per_page item đầu tiên bằng hàm gốc flatsome_portfolio_shortcode()
 *   3. Nếu còn item, hiển thị nút "Xem thêm dự án"
 */
function namanh_portfolio_with_loadmore( $atts, $content = null, $tag = '' ) {
	// Đếm instance trên mỗi trang để tạo ID duy nhất
	static $portfolio_instance = 0;
	$portfolio_instance++;

	// Đặt _id cố định (không random) để JS có thể tìm container
	if ( empty( $atts['_id'] ) ) {
		$atts['_id'] = 'portfolio-du-an-' . $portfolio_instance;
	}
	$portfolio_id = $atts['_id'];

	// Số item mỗi lần tải (mặc định: 6)
	$per_page = isset( $atts['per_page'] ) ? absint( $atts['per_page'] ) : 6;
	if ( $per_page < 1 ) $per_page = 6;

	// --- Đếm tổng số item khớp với bộ lọc ---
	$count_args = array(
		'post_type'      => 'featured_item',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
	);

	if ( ! empty( $atts['ids'] ) ) {
		$count_args['post__in'] = array_map( 'absint', explode( ',', $atts['ids'] ) );
	} else {
		if ( ! empty( $atts['cat'] ) ) {
			$count_args['tax_query'] = array( array(
				'taxonomy' => 'featured_item_category',
				'field'    => 'id',
				'terms'    => array_map( 'absint', explode( ',', $atts['cat'] ) ),
			) );
		}
		if ( ! empty( $atts['exclude'] ) ) {
			$count_args['post__not_in'] = array_map( 'absint', explode( ',', $atts['exclude'] ) );
		}
	}

	$count_q     = new WP_Query( $count_args );
	$total_items = $count_q->found_posts;
	wp_reset_postdata();

	// --- Render per_page item đầu tiên bằng hàm gốc Flatsome ---
	$render_atts           = $atts;
	$render_atts['number'] = $per_page; // Giới hạn số item render ban đầu
	// 'per_page' không có trong shortcode_atts của Flatsome nên sẽ bị bỏ qua tự động

	$initial_html = flatsome_portfolio_shortcode( $render_atts, $content, $tag );

	// --- Thêm nút Load More nếu còn item ---
	$load_more_html = '';
	if ( $total_items > $per_page ) {
		// Encode các thuộc tính cần thiết để AJAX render đúng style
		$ajax_atts = $atts;
		unset( $ajax_atts['per_page'] ); // Loại bỏ attr custom
		unset( $ajax_atts['_id'] );      // ID không cần thiết cho AJAX

		$load_more_html = sprintf(
			'<div class="namanh-load-more-wrapper" id="loadmore-wrapper-%1$s">
				<button class="namanh-load-more-btn"
					data-portfolio-id="%1$s"
					data-offset="%2$d"
					data-per-page="%2$d"
					data-total="%3$d"
					data-nonce="%4$s"
					data-atts="%5$s"
					aria-label="Tải thêm dự án">
					<span class="namanh-btn-label">Xem thêm dự án</span>
					<span class="namanh-btn-loading" style="display:none;">
						<span class="loading-spin small dark"></span>&nbsp;Đang tải...
					</span>
				</button>
				<p class="namanh-load-more-count">
					Đang hiển thị <span class="shown">%2$d</span> / <span class="total">%3$d</span> dự án
				</p>
			</div>',
			esc_attr( $portfolio_id ),                  // %1$s – portfolio ID
			$per_page,                                  // %2$d – offset ban đầu = per_page
			$total_items,                               // %3$d – tổng số item
			wp_create_nonce( 'namanh_load_more_portfolio' ), // %4$s – nonce bảo mật
			esc_attr( wp_json_encode( $ajax_atts ) )    // %5$s – atts JSON để AJAX dùng
		);
	}

	return $initial_html . $load_more_html;
}

/**
 * Bước 3: Helper – Render HTML một portfolio item.
 * Phải được gọi TRONG WordPress loop (have_posts / the_post đã được gọi).
 */
function namanh_render_single_portfolio_item( $atts ) {
	// Lấy style mặc định của theme nếu không truyền vào
	$style = ! empty( $atts['style'] ) ? $atts['style'] : flatsome_option( 'portfolio_style' );

	// Xây dựng các class CSS (giống hệt flatsome_portfolio_shortcode gốc)
	$classes_box   = array( 'portfolio-box', 'box', 'has-hover' );
	$classes_image = array();
	$classes_text  = array( 'box-text' );

	if ( $style )              $classes_box[] = 'box-' . $style;
	if ( $style === 'overlay' ) {
		$classes_box[] = 'dark';
		if ( empty( $atts['image_overlay'] ) ) $atts['image_overlay'] = true;
	}
	if ( $style === 'shade' )  $classes_box[] = 'dark';
	if ( $style === 'badge' )  $classes_box[] = 'hover-dark';
	if ( ! empty( $atts['text_pos'] ) ) $classes_box[] = 'box-text-' . $atts['text_pos'];

	$image_height = ! empty( $atts['image_height'] ) ? $atts['image_height'] : '100%';
	if ( ! empty( $atts['image_hover'] ) )     $classes_image[] = 'image-' . $atts['image_hover'];
	if ( ! empty( $atts['image_hover_alt'] ) ) $classes_image[] = 'image-' . $atts['image_hover_alt'];
	if ( $image_height )                       $classes_image[] = 'image-cover';

	$text_align = ! empty( $atts['text_align'] ) ? $atts['text_align'] : 'center';
	if ( ! empty( $atts['text_hover'] ) ) $classes_text[] = 'show-on-hover hover-' . $atts['text_hover'];
	if ( $text_align )                    $classes_text[] = 'text-' . $text_align;
	if ( ! empty( $atts['text_size'] ) ) $classes_text[] = 'is-' . $atts['text_size'];
	if ( isset( $atts['text_color'] ) && $atts['text_color'] === 'dark' ) $classes_text[] = 'dark';

	// Inline CSS args (dùng helper get_shortcode_inline_css của Flatsome)
	$image_radius = ! empty( $atts['image_radius'] ) ? $atts['image_radius'] : '';
	$image_width  = ! empty( $atts['image_width'] )  ? $atts['image_width']  : '';
	$text_bg      = ! empty( $atts['text_bg'] )      ? $atts['text_bg']      : '';
	$text_padding = ! empty( $atts['text_padding'] )  ? $atts['text_padding']  : '';

	$css_col = array(
		array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => '%' ),
	);
	$css_args_img = array(
		array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => '%' ),
		array( 'attribute' => 'width',         'value' => $image_width,  'unit' => '%' ),
	);
	$css_image_height = array(
		array( 'attribute' => 'padding-top', 'value' => $image_height ),
	);
	$css_args = array(
		array( 'attribute' => 'background-color', 'value' => $text_bg ),
		array( 'attribute' => 'padding',           'value' => $text_padding ),
	);

	// Animate attribute
	$animate_attr = '';
	if ( ! empty( $atts['animate'] ) ) {
		$animate_attr = 'data-animate="' . esc_attr( $atts['animate'] ) . '"';
	}

	// Link và lightbox
	$link         = get_permalink( get_the_ID() );
	$has_lightbox = '';
	if ( ! empty( $atts['lightbox'] ) && $atts['lightbox'] === 'true' ) {
		$lb_size = ! empty( $atts['lightbox_image_size'] ) ? $atts['lightbox_image_size'] : 'original';
		$lb_src  = wp_get_attachment_image_src( get_post_thumbnail_id(), $lb_size );
		if ( $lb_src ) $link = $lb_src[0];
		$has_lightbox = 'lightbox-gallery';
	}

	$image      = get_post_thumbnail_id();
	$image_size = ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'medium';
	$image_overlay = isset( $atts['image_overlay'] ) ? $atts['image_overlay'] : '';

	// Terms (cho filter nếu có dùng sau này)
	$terms_str = strip_tags(
		get_the_term_list( get_the_ID(), 'featured_item_category', '[&quot;', '&quot;,&quot;', '&quot;]' )
	);

	ob_start();
	?>
	<div class="col"
	     data-terms="<?php echo $terms_str; ?>"
	     <?php echo $animate_attr; ?>>
		<div class="col-inner" <?php echo get_shortcode_inline_css( $css_col ); ?>>
			<a href="<?php echo esc_url( $link ); ?>" class="plain <?php echo esc_attr( $has_lightbox ); ?>">
				<div class="<?php echo esc_attr( implode( ' ', $classes_box ) ); ?>">
					<div class="box-image" <?php echo get_shortcode_inline_css( $css_args_img ); ?>>
						<div class="<?php echo esc_attr( implode( ' ', $classes_image ) ); ?>" <?php echo get_shortcode_inline_css( $css_image_height ); ?>>
							<?php echo wp_get_attachment_image( $image, $image_size ); ?>
							<?php if ( $image_overlay ) : ?>
								<div class="overlay" style="background-color:<?php echo esc_attr( is_string( $image_overlay ) ? $image_overlay : '' ); ?>"></div>
							<?php endif; ?>
							<?php if ( $style === 'shade' ) : ?>
								<div class="shade"></div>
							<?php endif; ?>
						</div>
					</div>
					<div class="<?php echo esc_attr( implode( ' ', $classes_text ) ); ?>" <?php echo get_shortcode_inline_css( $css_args ); ?>>
						<div class="box-text-inner">
							<h6 class="uppercase portfolio-box-title title-du-an2"><?php the_title(); ?></h6>
							<?php
							$address = get_post_meta( get_the_ID(), '_featured_item_address', true );
							if ( $address ) :
							?>
								<p class="address-duan"><?php echo esc_html( $address ); ?></p>
							<?php endif; ?>
							<p class="uppercase portfolio-box-category is-xsmall op-6">
								<span class="show-on-hover">
									<?php echo strip_tags( get_the_term_list( get_the_ID(), 'featured_item_category', '', ', ' ) ); ?>
								</span>
							</p>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

/**
 * Bước 4: AJAX Handler – Trả về HTML các item tiếp theo.
 *
 * POST params:
 *   nonce    – wp_nonce
 *   offset   – vị trí bắt đầu (số item đã hiển thị)
 *   per_page – số item cần tải thêm
 *   atts     – JSON string chứa shortcode attributes
 */
function namanh_ajax_load_more_portfolio() {
	// Kiểm tra nonce bảo mật
	if ( ! check_ajax_referer( 'namanh_load_more_portfolio', 'nonce', false ) ) {
		wp_send_json_error( array( 'message' => 'Nonce không hợp lệ.' ), 403 );
	}

	// Sanitize tham số
	$offset   = absint( $_POST['offset']   ?? 0 );
	$per_page = absint( $_POST['per_page'] ?? 6 );
	if ( $per_page < 1 || $per_page > 50 ) $per_page = 6;

	$raw_atts = json_decode( stripslashes( $_POST['atts'] ?? '{}' ), true );
	if ( ! is_array( $raw_atts ) ) $raw_atts = array();

	// Sanitize query params từ atts
	$cat     = sanitize_text_field( $raw_atts['cat']     ?? '' );
	$orderby = sanitize_key( $raw_atts['orderby']        ?? 'menu_order' );
	$order   = strtoupper( sanitize_text_field( $raw_atts['order'] ?? '' ) );
	if ( ! in_array( $order, array( 'ASC', 'DESC' ), true ) ) $order = '';
	$exclude = sanitize_text_field( $raw_atts['exclude'] ?? '' );
	$ids_raw = sanitize_text_field( $raw_atts['ids']     ?? '' );

	// Build query args
	$args = array(
		'post_type'      => 'featured_item',
		'post_status'    => 'publish',
		'posts_per_page' => $per_page,
		'offset'         => $offset,
		'orderby'        => $orderby,
	);
	if ( $order ) $args['order'] = $order;

	if ( $ids_raw ) {
		// Lọc theo ID cụ thể
		$args['post__in'] = array_map( 'absint', explode( ',', $ids_raw ) );
		$args['orderby']  = 'post__in';
	} elseif ( $cat ) {
		// Lọc theo taxonomy category
		$args['tax_query'] = array( array(
			'taxonomy' => 'featured_item_category',
			'field'    => 'id',
			'terms'    => array_map( 'absint', explode( ',', $cat ) ),
		) );
		if ( $exclude ) {
			$args['post__not_in'] = array_map( 'absint', explode( ',', $exclude ) );
		}
	}

	$query = new WP_Query( $args );

	// Render HTML cho từng item
	$html = '';
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$html .= namanh_render_single_portfolio_item( $raw_atts );
		}
	}
	wp_reset_postdata();

	// Đếm tổng item (cùng bộ lọc, không phân trang) để biết còn không
	$total_args = array(
		'post_type'      => 'featured_item',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
	);
	if ( $ids_raw ) {
		$total_args['post__in'] = array_map( 'absint', explode( ',', $ids_raw ) );
	} elseif ( $cat ) {
		$total_args['tax_query'] = array( array(
			'taxonomy' => 'featured_item_category',
			'field'    => 'id',
			'terms'    => array_map( 'absint', explode( ',', $cat ) ),
		) );
		if ( $exclude ) {
			$total_args['post__not_in'] = array_map( 'absint', explode( ',', $exclude ) );
		}
	}
	$total_q    = new WP_Query( $total_args );
	$total      = $total_q->found_posts;
	wp_reset_postdata();

	$new_offset = $offset + $query->post_count;
	$has_more   = $new_offset < $total;

	wp_send_json_success( array(
		'html'       => $html,        // HTML các item mới
		'has_more'   => $has_more,    // Còn item không?
		'new_offset' => $new_offset,  // Offset mới cho lần sau
		'total'      => $total,       // Tổng số item
	) );
}

// Đăng ký AJAX handler (cả logged-in và không login)
add_action( 'wp_ajax_namanh_load_more_portfolio',        'namanh_ajax_load_more_portfolio' );
add_action( 'wp_ajax_nopriv_namanh_load_more_portfolio', 'namanh_ajax_load_more_portfolio' );

