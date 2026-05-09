<?php
/**
 * Shop category filter button template
 *
 * @package flatsome
 */

$layout = get_theme_mod( 'category_sidebar', 'left-sidebar' );
if ( 'none' === $layout || ( get_theme_mod( 'html_shop_page_content' ) && ! is_product_category() && ! is_product_tag() && ! is_search() ) ) {
	return;
}

$after = 'data-visible-after="true"';
$class = 'show-for-medium';
if ( 'off-canvas' === $layout ) {
	$after = '';
	$class = '';
}

$filter_text = 'Bộ lọc';
?>
<div class="category-filtering category-filter-row <?php echo esc_attr( $class ); ?>">
	<a href="#" data-open="#shop-sidebar" <?php echo wp_kses( $after, array( 'data-visible-after' => array() ) ); ?> data-pos="left" class="filter-button uppercase plain custom-vertical-filter">
		<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="filter-icon"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
		<strong><?php echo esc_html( $filter_text ); ?></strong>
	</a>
	<div class="inline-block">
		<?php the_widget( 'WC_Widget_Layered_Nav_Filters' ); ?>
	</div>
</div>
