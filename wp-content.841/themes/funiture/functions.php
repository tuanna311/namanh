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

function namanh_load_google_fonts() {
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Roboto:wght@400;500;700&display=swap',
        false
    );
}
add_action('wp_enqueue_scripts', 'namanh_load_google_fonts');
